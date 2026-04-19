<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        $books = $query->latest()->paginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'author' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'category_id' => ['required', 'exists:categories,id'],
            'published_year' => ['required', 'integer', 'between:1900,' . date('Y')],
            'available_copies' => ['required', 'integer', 'min:0', 'max:1000'],
        ]);

        $existingBook = Book::where('title', $validated['title'])
            ->where('author', $validated['author'])
            ->first();

        if ($existingBook) {
            return back()
                ->withInput()
                ->withErrors([
                    'title' => 'This book already exists in the library.',
                ]);
        }

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function show(Book $book)
    {
        $book->load(['category', 'reservations.user']);
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'author' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'category_id' => ['required', 'exists:categories,id'],
            'published_year' => ['required', 'integer', 'between:1900,' . date('Y')],
            'available_copies' => ['required', 'integer', 'min:0', 'max:1000'],
        ]);

        $existingBook = Book::where('title', $validated['title'])
            ->where('author', $validated['author'])
            ->where('id', '!=', $book->id)
            ->first();

        if ($existingBook) {
            return back()
                ->withInput()
                ->withErrors([
                    'title' => 'A book with this title and author already exists.',
                ]);
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
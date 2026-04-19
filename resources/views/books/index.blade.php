@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold">Books</h1>
        <p class="text-slate-600">Browse and reserve available books.</p>
    </div>
</div>

<form method="GET" class="bg-white rounded-xl shadow p-4 mb-6 grid md:grid-cols-3 gap-4">
    <div>
        <label class="block mb-1 font-medium">Search</label>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Title or author" class="w-full border rounded px-3 py-2">
    </div>
    <div>
        <label class="block mb-1 font-medium">Category</label>
        <select name="category_id" class="w-full border rounded px-3 py-2">
            <option value="">All categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex items-end gap-2">
        <button class="bg-sky-600 text-white px-4 py-2 rounded hover:bg-sky-700">Filter</button>
        <a href="{{ route('books.index') }}" class="bg-slate-300 px-4 py-2 rounded hover:bg-slate-400">Reset</a>
    </div>
</form>

<div class="grid md:grid-cols-3 gap-4">
    @forelse($books as $book)
        <div class="bg-white rounded-xl shadow p-5 flex flex-col">
            <div class="text-xs uppercase text-sky-600 font-semibold mb-2">{{ $book->category->name }}</div>
            <h2 class="text-xl font-bold mb-1">{{ $book->title }}</h2>
            <p class="text-slate-600 mb-2">{{ $book->author }}</p>
            <p class="text-sm text-slate-500 mb-3">Published: {{ $book->published_year }}</p>
            <p class="text-sm mb-4 flex-1">{{ \Illuminate\Support\Str::limit($book->description, 100) }}</p>
            <p class="text-sm font-medium mb-4">Available copies: {{ $book->available_copies }}</p>
            <div class="flex gap-2">
                <a href="{{ route('books.show', $book) }}" class="text-sky-600 hover:underline">View</a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('books.edit', $book) }}" class="text-amber-600 hover:underline">Edit</a>
                @endif
            </div>
        </div>
    @empty
        <p>No books found.</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $books->links() }}
</div>
@endsection

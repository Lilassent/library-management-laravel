@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="mb-3 text-sm text-sky-600 font-semibold uppercase">{{ $book->category->name }}</div>
    <h1 class="text-3xl font-bold mb-2">{{ $book->title }}</h1>
    <p class="text-lg text-slate-600 mb-2">by {{ $book->author }}</p>
    <p class="text-slate-500 mb-4">Published: {{ $book->published_year }}</p>
    <p class="mb-6">{{ $book->description }}</p>

    <div class="mb-6 font-medium">Available copies: {{ $book->available_copies }}</div>

    @if(auth()->user()->role === 'user')
        <form action="{{ route('reservations.store', $book) }}" method="POST">
            @csrf
            <button @disabled($book->available_copies < 1) class="bg-sky-600 text-white px-5 py-2 rounded hover:bg-sky-700 disabled:bg-slate-400">
                Reserve Book
            </button>
        </form>
    @endif

    @if(auth()->user()->role === 'admin')
        <div class="flex gap-3 mt-6">
            <a href="{{ route('books.edit', $book) }}" class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-600">Edit</a>
            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Delete this book?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
            </form>
        </div>
    @endif
</div>
@endsection

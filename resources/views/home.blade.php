@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow p-8 mb-8">
    <h1 class="text-4xl font-bold mb-3">Library Management System</h1>
    <p class="text-slate-600 mb-6">A Laravel project with authentication, database, validation, routing, controllers, models, and Blade templates.</p>
    <div class="flex gap-3">
        <a href="{{ route('books.index') }}" class="bg-sky-600 text-white px-5 py-2 rounded hover:bg-sky-700">Browse Books</a>
        @guest
            <a href="{{ route('register') }}" class="bg-slate-800 text-white px-5 py-2 rounded hover:bg-slate-900">Create Account</a>
        @endguest
    </div>
</div>

<h2 class="text-2xl font-semibold mb-4">Latest Books</h2>
<div class="grid md:grid-cols-3 gap-4">
    @forelse($books as $book)
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-xs uppercase text-sky-600 font-semibold mb-2">{{ $book->category->name }}</div>
            <h3 class="text-xl font-bold mb-1">{{ $book->title }}</h3>
            <p class="text-slate-600 mb-2">by {{ $book->author }}</p>
            <p class="text-sm text-slate-500 mb-4">Available copies: {{ $book->available_copies }}</p>
            <a href="{{ route('books.show', $book) }}" class="text-sky-600 hover:underline">View details</a>
        </div>
    @empty
        <p>No books found.</p>
    @endforelse
</div>
@endsection

@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Edit Book</h1>
@include('books.partials.form', ['action' => route('books.update', $book), 'method' => 'PUT', 'book' => $book])
@endsection
@error('title')
    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
@enderror
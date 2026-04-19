@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Add Book</h1>
@include('books.partials.form', ['action' => route('books.store'), 'method' => 'POST', 'book' => null])
@endsection
@error('title')
    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
@enderror
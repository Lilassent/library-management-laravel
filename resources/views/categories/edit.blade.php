@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Edit Category</h1>
@include('categories.partials.form', ['action' => route('categories.update', $category), 'method' => 'PUT', 'category' => $category])
@endsection

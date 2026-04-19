@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Add Category</h1>
@include('categories.partials.form', ['action' => route('categories.store'), 'method' => 'POST', 'category' => null])
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Library Management') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900">
<nav class="bg-slate-900 text-white">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="font-bold text-xl">Library Management</a>

        <div class="flex items-center gap-3 text-sm">
            <a href="{{ route('books.index') }}" class="hover:text-sky-300">Books</a>

            @auth
                <a href="{{ route('reservations.my') }}" class="hover:text-sky-300">My Reservations</a>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('categories.index') }}" class="hover:text-sky-300">Categories</a>
                    <a href="{{ route('books.create') }}" class="hover:text-sky-300">Add Book</a>
                    <a href="{{ route('reservations.index') }}" class="hover:text-sky-300">All Reservations</a>
                @endif

                <span class="text-slate-300">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-sky-300">Login</a>
                <a href="{{ route('register') }}" class="bg-sky-500 px-3 py-1 rounded hover:bg-sky-600">Register</a>
            @endauth
        </div>
    </div>
</nav>

<main class="max-w-6xl mx-auto p-4">
    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 border border-green-300 text-green-800 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 rounded bg-red-100 border border-red-300 text-red-800 px-4 py-3">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>

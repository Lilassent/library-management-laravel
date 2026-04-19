<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $fiction = Category::create(['name' => 'Fiction']);
        $science = Category::create(['name' => 'Science']);
        $history = Category::create(['name' => 'History']);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        Book::create([
            'title' => '1984',
            'author' => 'George Orwell',
            'description' => 'A dystopian novel about totalitarian control and surveillance.',
            'category_id' => $fiction->id,
            'published_year' => 1949,
            'available_copies' => 3,
        ]);

        Book::create([
            'title' => 'A Brief History of Time',
            'author' => 'Stephen Hawking',
            'description' => 'An accessible introduction to cosmology and the universe.',
            'category_id' => $science->id,
            'published_year' => 1988,
            'available_copies' => 2,
        ]);

        Book::create([
            'title' => 'Sapiens',
            'author' => 'Yuval Noah Harari',
            'description' => 'A broad overview of the history of humankind.',
            'category_id' => $history->id,
            'published_year' => 2011,
            'available_copies' => 4,
        ]);
    }
}

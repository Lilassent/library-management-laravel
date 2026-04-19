# Library Management System

## Overview

This project is a web-based Library Management System built with Laravel and MySQL.
It allows users to browse books, make reservations, and manage library data through an admin panel.

The application follows MVC architecture and demonstrates core Laravel concepts.

---

## Features

### User

* Registration and login
* Browse books
* Search by title or author
* Filter by category
* View book details
* Reserve books
* View personal reservations

### Admin

* Create, edit, delete books
* Manage categories
* View all reservations
* Update reservation status
* Duplicate book validation

---

## Technologies

* Laravel (PHP)
* MySQL
* Blade templates
* XAMPP

---

## Project Structure

* Models: `app/Models`
* Controllers: `app/Http/Controllers`
* Views: `resources/views`
* Routes: `routes/web.php`

---

## Authentication

The system includes basic authentication:

* Login
* Registration
* Role-based access (admin and user)

---

## Database

Main entities:

* Users
* Books
* Categories
* Reservations

---

## Setup Instructions

1. Clone the repository:

```bash
git clone https://github.com/yourusername/library-management-laravel.git
```

2. Open the project:

```bash
cd library_project
```

3. Install dependencies:

```bash
composer install
```

4. Create environment file:

```bash
cp .env.example .env
```

5. Configure database in `.env`:

```env
DB_DATABASE=library_db
DB_USERNAME=root
DB_PASSWORD=
```

6. Generate application key:

```bash
php artisan key:generate
```

7. Run migrations and seed:

```bash
php artisan migrate --seed
```

8. Start server:

```bash
php artisan serve
```

9. Open in browser:
   http://127.0.0.1:8000

---

## Test Accounts

Admin:
[admin@example.com](mailto:admin@example.com)
password

User:
[user@example.com](mailto:user@example.com)
password

---

## Evaluation Criteria Covered

* Routing
* Models
* Controllers
* Views
* Authentication
* Database integration
* Form validation

---

## Author

Student project – Library Management System

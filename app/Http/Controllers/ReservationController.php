<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'book'])
            ->latest()
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    public function myReservations()
    {
        $reservations = Reservation::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('reservations.my', compact('reservations'));
    }

    public function store(Book $book)
    {
        if ($book->available_copies < 1) {
            return back()->with('error', 'This book is currently unavailable.');
        }

        $alreadyReserved = Reservation::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($alreadyReserved) {
            return back()->with('error', 'You already have an active reservation for this book.');
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'pending',
            'reserved_at' => now(),
        ]);

        $book->decrement('available_copies');

        return redirect()->route('reservations.my')->with('success', 'Book reserved successfully.');
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected,returned'],
        ]);

        $oldStatus = $reservation->status;
        $newStatus = $validated['status'];

        $reservation->update(['status' => $newStatus]);

        if (in_array($oldStatus, ['pending', 'approved']) && in_array($newStatus, ['rejected', 'returned'])) {
            $reservation->book()->increment('available_copies');
        }

        return back()->with('success', 'Reservation status updated successfully.');
    }
}

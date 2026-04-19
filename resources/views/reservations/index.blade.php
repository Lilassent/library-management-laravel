@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">All Reservations</h1>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-100">
            <tr>
                <th class="text-left px-4 py-3">User</th>
                <th class="text-left px-4 py-3">Book</th>
                <th class="text-left px-4 py-3">Reserved At</th>
                <th class="text-left px-4 py-3">Status</th>
                <th class="text-left px-4 py-3">Change Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $reservation->user->name }}</td>
                    <td class="px-4 py-3">{{ $reservation->book->title }}</td>
                    <td class="px-4 py-3">{{ $reservation->reserved_at->format('d.m.Y H:i') }}</td>
                    <td class="px-4 py-3 capitalize">{{ $reservation->status }}</td>
                    <td class="px-4 py-3">
                        <form action="{{ route('reservations.status', $reservation) }}" method="POST" class="flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="border rounded px-2 py-1">
                                @foreach(['pending', 'approved', 'rejected', 'returned'] as $status)
                                    <option value="{{ $status }}" @selected($reservation->status === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            <button class="bg-sky-600 text-white px-3 py-1 rounded">Save</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-3">No reservations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $reservations->links() }}</div>
@endsection

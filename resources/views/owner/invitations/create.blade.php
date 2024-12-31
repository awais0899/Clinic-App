@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Invite Therapist for {{ $clinic->name }}</h1>

    <!-- Display Success or Error Messages -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Invitation Form -->
    <form action="{{ route('owner.clinics.invitations.store', $clinic) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Therapist Email</label>
            <input type="email" id="email" name="email" class="border rounded w-full py-2 px-3" required>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Send Invitation
        </button>
    </form>
</div>
@endsection

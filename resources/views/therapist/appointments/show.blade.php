@extends('layouts.app')

@section('title', 'Appointment Details')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Appointment Details</h1>

    <div class="bg-white shadow-lg rounded-lg p-6 mb-6 border-l-4 border-blue-500">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-3">
                <i class="fas fa-user-circle text-4xl text-blue-500"></i>
                <h5 class="text-2xl font-medium text-gray-800">{{ $appointment->client->name }}</h5>
            </div>
            <span class="text-sm text-gray-500">{{ $appointment->created_at->format('M d, Y') }}</span>
        </div>

        <div class="flex justify-between items-center mb-4">
            <div class="text-lg text-gray-700 font-medium">
                <p><strong>Service:</strong> {{ $appointment->menu->name }}</p>
                <p><strong>Status:</strong> 
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold 
                    {{ $appointment->status == 'completed' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </p>
            </div>
            <div>
                <a href="{{ route('therapist.dashboard') }}" 
                   class="inline-flex items-center bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-4 py-2 rounded-lg shadow-md hover:from-indigo-600 hover:to-purple-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>
            </div>
        </div>

        <div class="space-y-4">
            <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                <p><strong>Diagnosis:</strong></p>
                <p class="text-gray-600">{{ $appointment->diagnosis ?? 'No diagnosis yet' }}</p>
            </div>
            <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                <p><strong>Notes:</strong></p>
                <p class="text-gray-600">{{ $appointment->notes ?? 'No notes yet' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

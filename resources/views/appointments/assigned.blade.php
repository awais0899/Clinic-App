@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Assigned Appointments</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-6 text-left">Patient</th>
                    <th class="py-3 px-6 text-left">Clinic</th>
                    <th class="py-3 px-6 text-left">Service</th>
                    <th class="py-3 px-6 text-left">Date & Time</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $appointment->patient->name }}</td>
                        <td class="py-4 px-6">{{ $appointment->clinic->name }}</td>
                        <td class="py-4 px-6">{{ $appointment->menu->service_name }}</td>
                        <td class="py-4 px-6">{{ $appointment->appointment_time->format('d M Y, H:i') }}</td>
                        <td class="py-4 px-6">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('therapist.appointments.show', $appointment) }}" 
                               class="text-blue-600 hover:text-blue-900">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 px-6 text-center text-gray-500">
                            No appointments assigned.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $appointments->links() }}
    </div>
</div>
@endsection
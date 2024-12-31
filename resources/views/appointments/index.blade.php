@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">My Appointments</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-6 text-left" aria-label="Clinic Name">Clinic</th>
                    <th class="py-3 px-6 text-left" aria-label="Service Name">Service</th>
                    <th class="py-3 px-6 text-left" aria-label="Appointment Date & Time">Date & Time</th>
                    <th class="py-3 px-6 text-left" aria-label="Appointment Status">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr class="border-b hover:bg-gray-50 cursor-pointer">
                        <td class="py-4 px-6">{{ $appointment->clinic->name }}</td>
                        <td class="py-4 px-6">
                            {{-- Check if menu exists before displaying service_name --}}
                            {{ $appointment->menu ? $appointment->menu->service_name : 'No Service Available' }}
                        </td>
                        <td class="py-4 px-6">
                            {{-- Check if appointment_time exists before formatting --}}
                            {{ $appointment->time ? $appointment->time->format('d M Y, H:i') : 'Date & Time Not Available' }}
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                    ($appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                    'bg-red-100 text-red-800') }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                            No appointments found. <a href="{{ route('patient.appointment.create', ['clinic' => $clinics->first()->slug]) }}" class="text-blue-600 hover:text-blue-800">Book your first appointment</a>
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

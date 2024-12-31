@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8">Patient Dashboard</h1>

    <!-- Dashboard Overview Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
            <div class="flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h3m2 0h3M5 12h.01M2 4l2 2m0 0l2 2m-2-2l2 2m0 0l2 2m6-10l2 2m0 0l2 2m-2-2l2 2m0 0l2 2m-6 4h12a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h12" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-800">Your Overview</h3>
            </div>
            <p class="text-gray-600 text-lg">Keep track of your upcoming and past appointments with ease.</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
            <div class="flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9m-9 0h-9m9 0V10m0 10V3M3 10l9 9l9-9" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-800">Available Clinics</h3>
            </div>
            <p class="text-gray-600 text-lg">Browse and book your next appointment at a nearby clinic.</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
            <div class="flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17l3 3l7-7" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-800">Past Appointments</h3>
            </div>
            <p class="text-gray-600 text-lg">Review your completed appointments and leave feedback.</p>
        </div>
    </div>

    <!-- Available Clinics Section -->
    <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Explore Clinics</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($clinics as $clinic)
                <div class="bg-gray-50 rounded-xl border shadow-md p-6 hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $clinic->name }}</h3>
                    </div>
                    <p class="text-gray-600 mb-3">{{ $clinic->description }}</p>
                    <p class="text-gray-600 mb-3"><strong>Address:</strong> {{ $clinic->address }}</p>
                    <p class="text-gray-600 mb-6"><strong>Phone:</strong> {{ $clinic->phone }}</p>
                    <form action="{{ route('patient.appointment.create', $clinic->slug) }}" method="GET">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Book an Appointment
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Upcoming Appointments Section -->
    <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Upcoming Appointments</h2>
        @if($upcomingAppointments->isEmpty())
            <p class="text-gray-600">No upcoming appointments.</p>
        @else
            <table class="min-w-full bg-white table-auto border-collapse rounded-xl shadow-md">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="py-4 px-6 text-left">Clinic</th>
                        <th class="py-4 px-6 text-left">Service</th>
                        <th class="py-4 px-6 text-left">Date & Time</th>
                        <th class="py-4 px-6 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($upcomingAppointments as $appointment)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-4 px-6">{{ $appointment->clinic->name }}</td>
                            <td class="py-4 px-6">{{ $appointment->menu ? $appointment->menu->service_name : 'No Service Available' }}</td>
                            <td class="py-4 px-6">{{ $appointment->time ? $appointment->time->format('H:i') : 'Not Set' }}</td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    {{ $appointment->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Past Appointments Section -->
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Past Appointments</h2>
        @if($pastAppointments->isEmpty())
            <p class="text-gray-600">No past appointments available.</p>
        @else
            <table class="min-w-full bg-white table-auto border-collapse rounded-xl shadow-md">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="py-4 px-6 text-left">Clinic</th>
                        <th class="py-4 px-6 text-left">Service</th>
                        <th class="py-4 px-6 text-left">Date & Time</th>
                        <th class="py-4 px-6 text-left">Status</th>
                        <th class="py-4 px-6 text-left">Review</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pastAppointments as $appointment)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-4 px-6">{{ $appointment->clinic->name }}</td>
                            <td class="py-4 px-6">{{ $appointment->menu ? $appointment->menu->service_name : 'No Service Available' }}</td>
                            <td class="py-4 px-6">{{ $appointment->time ? $appointment->time->format('H:i') : 'Not Set' }}</td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    {{ $appointment->status === 'completed' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                @if($appointment->review)
                                    <a href="{{ route('patient.reviews.create', $appointment) }}" class="text-blue-600 hover:text-blue-800">Reviewed</a>
                                @else
                                    <a href="{{ route('patient.reviews.create', $appointment) }}" class="text-blue-600 hover:text-blue-800">Leave a Review</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        @endif
    </div>
</div>
@endsection

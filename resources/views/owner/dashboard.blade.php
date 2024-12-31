@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50/50">
    <div class="container mx-auto px-4 py-8">
        <!-- Dashboard Header with Gradient Background -->
        <div class="relative mb-10 p-8 rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500">
            <div class="absolute inset-0 bg-white/10 backdrop-blur-sm rounded-2xl"></div>
            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight">
                    Welcome Back
                    <span class="block text-lg font-normal mt-2 text-indigo-100">Manage your clinics and appointments</span>
                </h1>
                <a href="{{ route('owner.clinics.create') }}" 
                   class="group flex items-center gap-2 bg-white/90 hover:bg-white text-indigo-600 font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                    <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Clinic
                </a>
            </div>
        </div>

        <!-- Notification Messages -->
        @if(session('success'))
            <div class="mb-6 transform transition-all animate-fade-in-down">
                <div class="flex items-center gap-3 bg-green-50 text-green-800 p-4 rounded-xl border border-green-100">
                    <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Dashboard Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Clinics Card -->
            <div class="group hover:scale-105 transition-transform duration-300">
                <div class="relative h-full bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100">
                    <div class="absolute top-6 right-6 w-12 h-12 flex items-center justify-center rounded-full bg-blue-50 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Your Clinics</h2>
                    <p class="text-4xl font-bold text-blue-600 mb-1">{{ $clinics->count() }}</p>
                    <p class="text-sm text-gray-500">Active Locations</p>
                </div>
            </div>

            <!-- Invitations Card -->
            <div class="group hover:scale-105 transition-transform duration-300">
                <div class="relative h-full bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100">
                    <div class="absolute top-6 right-6 w-12 h-12 flex items-center justify-center rounded-full bg-amber-50 text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Pending Invitations</h2>
                    <p class="text-4xl font-bold text-amber-600 mb-1">{{ $pendingInvitations->count() }}</p>
                    <p class="text-sm text-gray-500">Awaiting Response</p>
                </div>
            </div>

            <!-- Therapists Card -->
            <div class="group hover:scale-105 transition-transform duration-300">
                <div class="relative h-full bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100">
                    <div class="absolute top-6 right-6 w-12 h-12 flex items-center justify-center rounded-full bg-green-50 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Total Therapists</h2>
                    <p class="text-4xl font-bold text-green-600 mb-1">{{ $therapists->count() }}</p>
                    <p class="text-sm text-gray-500">Active Team Members</p>
                </div>
            </div>
        </div>

        <!-- Pending Appointments Section -->
        <div class="mt-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800">Pending Appointments</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($pendingAppointments as $appointment)
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">
                                        {{ $appointment->client->name ?? 'No Client Assigned' }}
                                    </h3>
                                    <p class="text-gray-600 mt-1">{{ $appointment->clinic->name ?? 'No Clinic Assigned' }} - {{ $appointment->menu->name ?? 'No Service Assigned' }}</p>
                                </div>
                                <form action="{{ route('owner.appointments.assignTherapist', $appointment) }}" method="POST" 
                                      class="flex flex-col sm:flex-row gap-3">
                                    @csrf
                                    @method('PATCH')
                                    <select name="therapist_id" 
                                            class="px-4 py-2 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors">
                                        <option value="" disabled selected>Select Therapist</option>
                                        @foreach($therapists as $therapist)
                                            <option value="{{ $therapist->id }}">{{ $therapist->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-sm transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Assign Therapist
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-12 px-4">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="mt-4 text-xl font-medium text-gray-600">No pending appointments</p>
                            <p class="mt-2 text-gray-500">All appointments have been assigned to therapists</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Clinics List Section -->
        <div class="mt-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800">Your Clinics</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($clinics as $clinic)
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $clinic->name }}</h3>
                                    <p class="text-gray-600 mt-1">{{ $clinic->address }}</p>
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('owner.clinics.edit', $clinic) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <a href="{{ route('owner.clinics.show', $clinic) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Details
                                    </a>
                                    <form action="{{ route('owner.clinics.destroy', $clinic) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-xl transition-colors"
                                                onclick="return confirm('Are you sure you want to delete this clinic?')">
                                            <svg class="w-5 h-5     <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-12 px-4">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <p class="mt-4 text-xl font-medium text-gray-600">No clinics added yet</p>
                            <p class="mt-2 text-gray-500">Get started by adding your first clinic</p>
                            <a href="{{ route('owner.clinics.create') }}" 
                               class="mt-4 inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-sm transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add First Clinic
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-7xl">
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 mb-8">
        <div class="flex flex-wrap justify-between items-center">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                {{ $clinic->name }}
            </h1>
            <div class="flex flex-wrap gap-3 mt-4 md:mt-0">
                <a href="{{ route('owner.clinics.edit', $clinic) }}" 
                   class="inline-flex items-center px-4 py-2 bg-white text-blue-600 rounded-lg shadow-sm hover:bg-blue-50 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('owner.clinics.menus.create', $clinic) }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg shadow-sm hover:bg-green-600 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Service
                </a>
                <a href="{{ route('owner.clinics.invitations.create', $clinic) }}" 
                   class="inline-flex items-center px-4 py-2 bg-purple-500 text-white rounded-lg shadow-sm hover:bg-purple-600 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Invite
                </a>
                <a href="{{ route('owner.appointments.index', $clinic) }}" 
                   class="inline-flex items-center px-4 py-2 bg-white text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Appointments
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-8">
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="border-b pb-4 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Clinic Information</h2>
                </div>
                <div class="grid gap-6">
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Category</span>
                            <p class="mt-1 text-gray-900">{{ $clinic->category->name }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Working Hours</span>
                            <p class="mt-1 text-gray-900">{{ $clinic->working_hours_start }} - {{ $clinic->working_hours_end }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Phone</span>
                            <p class="mt-1 text-gray-900">{{ $clinic->phone }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Email</span>
                            <p class="mt-1 text-gray-900">{{ $clinic->email }}</p>
                        </div>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Description</span>
                        <p class="mt-1 text-gray-900">{{ $clinic->description }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Working Days</span>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach(json_decode($clinic->working_days, true) as $day)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $day }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Address</span>
                        <p class="mt-1 text-gray-900">{{ $clinic->address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="border-b pb-4 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Clinic Image</h2>
                </div>
                @if($clinic->image)
                    <img src="{{ Storage::url($clinic->image) }}" 
                         alt="{{ $clinic->name }}" 
                         class="w-full h-64 object-cover rounded-lg">
                @else
                    <div class="bg-gray-50 rounded-lg p-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">No image available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Services</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $service)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden transition-all hover:shadow-lg">
                    @if($service->image)
                        <img src="{{ Storage::url($service->image) }}" 
                             alt="{{ $service->service_name }}" 
                             class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-gray-900">{{ $service->service_name }}</h3>
                        <p class="mt-2 text-sm text-gray-600">{{ $service->description }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-2xl font-bold text-gray-900">${{ number_format($service->price, 2) }}</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $service->duration }} min
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-gray-50 rounded-2xl p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No services</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new service.</p>
                        <div class="mt-6">
                            <a href="{{ route('owner.clinics.menus.create', $clinic) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add Service
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        
        <div class="mt-6">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection
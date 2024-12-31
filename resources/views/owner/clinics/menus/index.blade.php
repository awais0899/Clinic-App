@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Services Menu</h1>
            <p class="text-gray-600">{{ $clinic->name }}</p>
        </div>
        <a href="{{ route('owner.clinics.menus.create', $clinic) }}" 
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Service
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($services as $service)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($service->image)
                    <img src="{{ Storage::url($service->image) }}" 
                         alt="{{ $service->service_name }}" 
                         class="w-full h-48 object-cover">
                @else
                    <div class="bg-gray-100 w-full h-48 flex items-center justify-center">
                        <span class="text-gray-400">No image available</span>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2">{{ $service->service_name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $service->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-gray-700">${{ number_format($service->price, 2) }}</span>
                        <span class="text-gray-500">{{ $service->duration }} minutes</span>
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <a href="{{ route('owner.clinics.menus.edit', [$clinic, $service]) }}" 
                           class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('owner.clinics.menus.destroy', [$clinic, $service]) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Are you sure you want to delete this service?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-500 hover:text-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8 bg-gray-50 rounded-lg">
                <p class="text-gray-500">No services found. Add your first service!</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $services->links() }}
    </div>
</div>
@endsection
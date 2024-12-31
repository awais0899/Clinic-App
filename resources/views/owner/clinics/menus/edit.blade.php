@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Edit Service: {{ $menu->name }}</h1>

        <form action="{{ route('owner.clinics.menus.update', [$clinic, $menu]) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $menu->name) }}" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4" 
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('description', $menu->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    Price
                </label>
                <input type="number" 
                       name="price" 
                       id="price" 
                       value="{{ old('price', $menu->price) }}" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('price')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Service Image
                </label>
                @if($menu->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($menu->image) }}" 
                             alt="{{ $menu->name }}" 
                             class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
                <input type="file" 
                       name="image" 
                       id="image" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('image')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Service
                </button>
                <a href="{{ route('owner.clinics.menus.index', $clinic) }}" 
                   class="text-blue-500 hover:text-blue-800">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

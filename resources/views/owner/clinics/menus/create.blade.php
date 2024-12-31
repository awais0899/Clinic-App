@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Add New Service</h1>
            <p class="text-gray-600">{{ $clinic->name }}</p>
        </div>

        <form action="{{ route('owner.clinics.menus.store', $clinic) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="service_name">
                    Service Name
                </label>
                <input type="text" 
                       name="service_name" 
                       id="service_name" 
                       value="{{ old('service_name') }}" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('service_name') border-red-500 @enderror">
                @error('service_name')
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
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4 mb-4">
                <div class="flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                        Price ($)
                    </label>
                    <input type="number" 
                           name="price" 
                           id="price" 
                           step="0.01" 
                           value="{{ old('price') }}" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">
                        Duration (minutes)
                    </label>
                    <input type="number" 
                           name="duration" 
                           id="duration" 
                           min="15" 
                           max="240" 
                           step="15" 
                           value="{{ old('duration', 30) }}" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('duration') border-red-500 @enderror">
                    @error('duration')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Service Image
                </label>
                <input type="file" 
                       name="image" 
                       id="image" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror">
                <div id="image-preview-container" style="display: none; margin-top: 10px;">
                    <img id="image-preview" src="#" alt="Image Preview" class="max-w-full h-auto rounded">
                </div>
                @error('image')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1" 
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="form-checkbox h-5 w-5 text-blue-600">
                    <span class="ml-2 text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Service
                </button>
                <a href="{{ route('owner.clinics.menus.index', $clinic) }}" 
                   class="text-blue-500 hover:text-blue-800">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('image-preview-container');
        const previewImage = document.getElementById('image-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
@endsection

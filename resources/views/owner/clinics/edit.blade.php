@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Edit Clinic: {{ $clinic->name }}</h1>

        <form action="{{ route('owner.clinics.update', $clinic) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                    Category
                </label>
                <select name="category_id" 
                        id="category_id" 
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('category_id') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $clinic->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Clinic Name
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $clinic->name) }}" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('name') border-red-500 @enderror">
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
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('description') border-red-500 @enderror">{{ old('description', $clinic->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                    Address
                </label>
                <input type="text" 
                       name="address" 
                       id="address" 
                       value="{{ old('address', $clinic->address) }}" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('address') border-red-500 @enderror">
                @error('address')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4 mb-4">
                <div class="flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Phone
                    </label>
                    <input type="tel" 
                           name="phone" 
                           id="phone" 
                           value="{{ old('phone', $clinic->phone) }}" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $clinic->email) }}" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex space-x-4 mb-4">
                <div class="flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="working_hours_start">
                        Opening Time
                    </label>
                    <input type="time" 
                           name="working_hours_start" 
                           id="working_hours_start" 
                           value="{{ old('working_hours_start', $clinic->working_hours_start) }}" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('working_hours_start') border-red-500 @enderror">
                    @error('working_hours_start')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="working_hours_end">
                        Closing Time
                    </label>
                    <input type="time" 
                           name="working_hours_end" 
                           id="working_hours_end" 
                           value="{{ old('working_hours_end', $clinic->working_hours_end) }}" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('working_hours_end') border-red-500 @enderror">
                    @error('working_hours_end')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Working Days</label>
                <div class="flex flex-wrap gap-4">
                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                        <label class="inline-flex items-center">
                            <input type="checkbox" 
                                   name="working_days[]" 
                                   value="{{ $day }}"
                                   {{ in_array($day, old('working_days', json_decode($clinic->working_days, true))) ? 'checked' : '' }}
                                   class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="ml-2">{{ $day }}</span>
                        </label>
                    @endforeach
                </div>
                @error('working_days')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Clinic Image
                </label>
                @if($clinic->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($clinic->image) }}" 
                             alt="{{ $clinic->name }}" 
                             class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
                <input type="file" 
                       name="image" 
                       id="image" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1" 
                           {{ old('is_active', $clinic->is_active) ? 'checked' : '' }}
                           class="form-checkbox h-5 w-5 text-blue-600">
                    <span class="ml-2 text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Clinic
                </button>
                <a href="{{ route('owner.clinics.show', $clinic) }}" 
                   class="text-blue-500 hover:text-blue-800">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
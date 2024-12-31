@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Write a Review</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <h2 class="text-lg font-semibold">Appointment Details</h2>
                <p class="text-gray-600">Clinic: {{ $appointment->clinic->name ?? 'N/A' }}</p>
                <p class="text-gray-600">Service: {{ $appointment->menu->service_name ?? 'N/A' }}</p>
                <p class="text-gray-600">Date: {{ $appointment->appointment_time ? $appointment->appointment_time->format('d M Y, H:i') : 'N/A' }}</p>
            </div>
    
            <form action="{{ route('patient.reviews.store', $appointment) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Rating
                    </label>
                    <div class="flex space-x-4">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="inline-flex items-center">
                                <input type="radio" name="rating" value="{{ $i }}" 
                                       class="form-radio h-4 w-4 text-blue-600" 
                                       {{ old('rating') == $i ? 'checked' : '' }}>
                                <span class="ml-2">{{ $i }}</span>
                            </label>
                        @endfor
                    </div>
                    @error('rating')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="comment">
                        Your Review
                    </label>
                    <textarea name="comment" id="comment" rows="4" 
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('comment') border-red-500 @enderror"
                              placeholder="Share your experience...">{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Submit Review
                    </button>
                    <a href="{{ route('patient.appointments.index') }}" 
                       class="text-blue-500 hover:text-blue-800">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Appointment Details</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <h2 class="text-lg font-bold">Patient Information</h2>
                <p><strong>Name:</strong> {{ $appointment->patient->name }}</p>
                <p><strong>Email:</strong> {{ $appointment->patient->email }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-lg font-bold">Appointment Information</h2>
                <p><strong>Clinic:</strong> {{ $appointment->clinic->name }}</p>
                <p><strong>Service:</strong> {{ $appointment->menu->service_name }}</p>
                <p><strong>Date & Time:</strong> {{ $appointment->appointment_time->format('d M Y, H:i') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
            </div>

            <form action="{{ route('therapist.appointments.update', $appointment) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="diagnosis">
                        Diagnosis
                    </label>
                    <textarea name="diagnosis" id="diagnosis" rows="4" 
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('diagnosis') border-red-500 @enderror">{{ old('diagnosis', $appointment->diagnosis) }}</textarea>
                    @error('diagnosis')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="notes">
                        Session Notes
                    </label>
                    <textarea name="notes" id="notes" rows="4" 
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('notes') border-red-500 @enderror">{{ old('notes', $appointment->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select name="status" id="status" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror">
                        <option value="confirmed" {{ old('status', $appointment->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ old('status', $appointment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Appointment
                    </button>
                    <a href="{{ route('therapist.appointments.index') }}" 
                       class="text-blue-500 hover:text-blue-800">Back to Appointments</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
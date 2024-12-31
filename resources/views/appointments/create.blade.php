@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Book Appointment</h1>

        <form action="{{ route('patient.appointments.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="menu_id">
                    Service
                </label>    
                <input type="hidden" name="clinic_id" value="{{ $services->id }}">
                <select name="menu_id" id="menu_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('menu_id') border-red-500 @enderror" required>
                    <option value="">Select Service</option>
                    @foreach($services->menu as $service)
                        <option value="{{ $service->id }}" {{ old('menu_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->service_name }} - ${{ number_format($service->price, 2) }}
                        </option>
                    @endforeach
                </select>
                @error('menu_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="appointment_date">
                    Appointment Date
                </label>
                <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('appointment_date') border-red-500 @enderror">
                @error('appointment_date')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="appointment_time">
                    Appointment Time
                </label>
                <select name="appointment_time" id="appointment_time" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('appointment_time') border-red-500 @enderror" required>
                    <option value="">Select Time</option>
                    @foreach($availableTimes as $time)
                        <option value="{{ $time }}" {{ old('appointment_time') == $time ? 'selected' : '' }}>
                            {{ $time }}
                        </option>
                    @endforeach
                </select>
                @error('appointment_time')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Book Appointment
                </button>
                <a href="{{ route('patient.appointments.index') }}" 
                   class="text-blue-500 hover:text-blue-800">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('appointment_date').addEventListener('change', function () {
    const date = this.value;
    const clinicId = {{ $clinic->id }};
    const timeSelect = document.getElementById('appointment_time');

    fetch(`/api/clinics/${clinicId}/slots/${date}`)
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        timeSelect.innerHTML = '<option value="">Select Time</option>';
        if (data.length === 0) {
            const option = document.createElement('option');
            option.textContent = "No slots available for this date";
            option.disabled = true;
            timeSelect.appendChild(option);
        } else {
            data.forEach(time => {
                const option = document.createElement('option');
                option.value = time;
                option.textContent = time;
                timeSelect.appendChild(option);
            });
        }
    })
    .catch(error => {
        console.error('Error fetching slots:', error);
        alert('Unable to fetch available slots. Please try again later.');
    });
});
</script>
@endsection
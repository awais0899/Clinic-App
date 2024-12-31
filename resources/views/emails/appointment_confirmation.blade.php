@component('mail::message')
# Appointment Confirmation

Dear {{ $appointment->client->name ?? 'Valued Patient' }},

Your appointment has been confirmed with the following details:

**Clinic:** {{ $appointment->clinic->name }}  
**Service:** {{ $appointment->menu ? $appointment->menu->service_name : 'No Service Available' }}  
**Date:** {{ $appointment->time ? \Carbon\Carbon::parse($appointment->time)->format('d M Y') : 'Date Not Available' }}  
**Time:** {{ $appointment->time ? \Carbon\Carbon::parse($appointment->time)->format('H:i') : 'Time Not Available' }}

@component('mail::button', ['url' => route('patient.appointments.index')])
View Appointment
@endcomponent

Please arrive 10 minutes before your scheduled appointment time.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

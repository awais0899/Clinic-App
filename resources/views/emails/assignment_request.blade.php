@component('mail::message')
# New Appointment Assigned

Dear {{ $therapist->name }},

You have been assigned to a new appointment. Here are the details:

**Client:** {{ $appointment->client ? $appointment->client->name : 'No Client Assigned' }}  
**Clinic:** {{ $appointment->clinic->name }}  
**Service:** {{ $appointment->menu ? $appointment->menu->service_name : 'No Service Available' }}  
**Date:** {{ $appointment->time ? \Carbon\Carbon::parse($appointment->time)->format('d M Y') : 'Date Not Available' }}  
**Time:** {{ $appointment->time ? \Carbon\Carbon::parse($appointment->time)->format('H:i') : 'Time Not Available' }}

Please log in to your dashboard for more details.

Thanks,  
{{ config('app.name') }}
@endcomponent

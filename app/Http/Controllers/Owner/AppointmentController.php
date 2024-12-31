<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Support\Facades\Mail;
use App\Mail\AssignmentRequestMail;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Clinic $clinic)
    {
        $this->authorize('view', $clinic);
        
        $appointments = $clinic->appointments()
            ->with(['client', 'therapist.user', 'service'])
            ->latest()
            ->paginate(10);
            
        $therapists = $clinic->therapists()
            ->with('user')
            ->where('is_active', true)
            ->get();
            
        return view('owner.appointments.index', compact('clinic', 'appointments', 'therapists'));
    }

    public function assignTherapist(Request $request, Appointment $appointment)
    {
        // Retrieve the therapist by their ID
        $therapist = User::findOrFail($request->therapist_id);
    
        // Check if the therapist is already assigned to the appointment
        if ($appointment->therapist_id === $therapist->id) {
            return redirect()->route('owner.dashboard')->with('info', 'This therapist is already assigned to this appointment.');
        }
    
        // Assign the therapist to the appointment
        $appointment->therapist_id = $therapist->id;
        $appointment->save();
    
        // Create the mail object
        $mail = new AssignmentRequestMail($therapist, $appointment);
    
        // Send email notification to the therapist
        try {
            Mail::to($therapist->email)->send($mail);
            return redirect()->route('owner.dashboard')->with('success', 'Therapist assigned successfully, and an email notification has been sent!');
        } catch (\Exception $e) {
            return redirect()->route('owner.dashboard')->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }
    
    public function store(Request $request)
    {
        // Logic to store the new appointment
        $appointment = Appointment::create($request->all());
        return redirect()->route('appointments.index');
    }
}

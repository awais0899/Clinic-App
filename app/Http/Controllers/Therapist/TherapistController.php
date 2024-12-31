<?php

namespace App\Http\Controllers\Therapist;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TherapistController extends Controller
{
    // Display the therapist's dashboard with appointments
    public function index()
    {
        // Fetch appointments with eager loading for the menu (service), and client (user)
        $appointments = Appointment::where('therapist_id', auth()->id())
            ->with(['menu', 'client']) // Eager load 'menu' and 'client'
            ->paginate(10);
    
        return view('therapist.dashboard', compact('appointments'));
    }
    

    // Mark an appointment as completed
    public function markComplete(Appointment $appointment)
    {
        // Ensure the appointment belongs to the authenticated therapist
        if ($appointment->therapist_id !== auth()->id()) {
            return redirect()->route('therapist.dashboard')->with('error', 'You are not authorized to complete this appointment.');
        }

        $appointment->update(['status' => 'completed']);

        return redirect()->route('therapist.dashboard')->with('success', 'Appointment marked as complete.');
    }

    // Add diagnosis and notes to an appointment
    public function addDiagnosis(Request $request, Appointment $appointment)
    {
        // Ensure the appointment belongs to the authenticated therapist
        if ($appointment->therapist_id !== auth()->id()) {
            return redirect()->route('therapist.dashboard')->with('error', 'You are not authorized to add a diagnosis to this appointment.');
        }

        // Validate the diagnosis input
        $request->validate([
            'diagnosis' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // Update the appointment with the diagnosis and notes
        $appointment->update([
            'diagnosis' => $request->diagnosis,
            'notes' => $request->notes,
        ]);

        return redirect()->route('therapist.dashboard')->with('success', 'Diagnosis added successfully.');
    }

    // Show details of a specific appointment
    public function show(Appointment $appointment)
    {
        // Ensure the appointment belongs to the authenticated therapist
        if ($appointment->therapist_id !== auth()->id()) {
            return redirect()->route('therapist.dashboard')->with('error', 'You are not authorized to view this appointment.');
        }
    
        // Eager load relationships for the appointment details
        $appointment->load(['menu', 'client']); // Load menu (service) and client
    
        return view('therapist.appointments.show', compact('appointment'));
    }
    
}

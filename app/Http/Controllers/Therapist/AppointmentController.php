<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    // Display the therapist's appointments with pagination
    public function index()
    {
        $appointments = auth()->user()->therapistAppointments()
            ->with('clinic', 'menu', 'client') // Ensure these relationships are defined in the Appointment model
            ->latest() // Sort by the latest appointment
            ->paginate(10); // Paginate results (10 appointments per page)
        
        return view('therapist.appointments.index', compact('appointments'));
    }

    // Show detailed appointment information
    public function show(Appointment $appointment)
    {
        // Authorize that the user can view this appointment
        $this->authorize('view', $appointment);
        
        return view('therapist.appointments.show', compact('appointment'));
    }

    // Update appointment details (e.g., diagnosis, status)
    public function update(Request $request, Appointment $appointment)
    {
        // Authorize that the user can update this appointment
        $this->authorize('update', $appointment);

        // Validate the request inputs
        $request->validate([
            'diagnosis' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:confirmed,completed'], // Only allowed statuses
        ]);

        try {
            // Update the appointment details
            $appointment->update($request->only('diagnosis', 'notes', 'status'));

            // Redirect with a success message
            return redirect()->route('therapist.appointments.index')
                ->with('success', 'Appointment updated successfully.');
        } catch (\Exception $e) {
            // Log the error and redirect with an error message
            Log::error('Error updating appointment: ' . $e->getMessage());
            return redirect()->route('therapist.appointments.index')
                ->with('error', 'There was an error updating the appointment. Please try again later.');
        }
    }
}

<?php

namespace App\Http\Controllers\API\Therapist;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TherapistController extends Controller
{
    // Fetch the therapist's appointments
    public function index()
    {
        // Fetch appointments with eager loading for the menu (service) and client (user)
        $appointments = Appointment::where('therapist_id', auth()->id())
            ->with(['menu', 'client'])
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $appointments,
        ]);
    }

    // Mark an appointment as completed
    public function markComplete(Appointment $appointment)
    {
        // Ensure the appointment belongs to the authenticated therapist
        if ($appointment->therapist_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to complete this appointment.',
            ], 403);
        }

        $appointment->update(['status' => 'completed']);

        return response()->json([
            'success' => true,
            'message' => 'Appointment marked as complete.',
        ]);
    }

    // Add diagnosis and notes to an appointment
    public function addDiagnosis(Request $request, Appointment $appointment)
    {
        // Ensure the appointment belongs to the authenticated therapist
        if ($appointment->therapist_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to add a diagnosis to this appointment.',
            ], 403);
        }

        // Validate the diagnosis input
        $validated = $request->validate([
            'diagnosis' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // Update the appointment with the diagnosis and notes
        $appointment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Diagnosis added successfully.',
        ]);
    }

    // Show details of a specific appointment
    public function show(Appointment $appointment)
    {
        // Ensure the appointment belongs to the authenticated therapist
        if ($appointment->therapist_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to view this appointment.',
            ], 403);
        }

        // Eager load relationships for the appointment details
        $appointment->load(['menu', 'client']); // Load menu (service) and client

        return response()->json([
            'success' => true,
            'data' => $appointment,
        ]);
    }
}

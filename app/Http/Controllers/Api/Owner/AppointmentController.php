<?php

namespace App\Http\Controllers\Api\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Menu;  // Updated to use Menu model
use Illuminate\Support\Facades\Mail;
use App\Mail\AssignmentRequestMail;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        // Get the first clinic associated with the authenticated user
        $clinic = $request->user()->clinics()->first();

        // Fetch appointments for that clinic
        $appointments = $clinic->appointments()
            ->with(['client', 'therapist.user', 'menu']) // Updated to use menu instead of service
            ->latest()
            ->paginate(10);

        return response()->json([
            'appointments' => $appointments
        ], 200);
    }

    public function assignTherapist(Request $request, Appointment $appointment)
    {
        // Validate therapist_id input
        $validator = Validator::make($request->all(), [
            'therapist_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        // Retrieve the therapist by ID
        $therapist = User::findOrFail($request->therapist_id);

        // Check if therapist is already assigned
        if ($appointment->therapist_id === $therapist->id) {
            return response()->json([
                'message' => 'This therapist is already assigned to this appointment.'
            ], 400);
        }

        // Assign the therapist to the appointment
        $appointment->therapist_id = $therapist->id;
        $appointment->save();

        // Send email notification to therapist
        $mail = new AssignmentRequestMail($therapist, $appointment);

        try {
            Mail::to($therapist->email)->send($mail);
            return response()->json([
                'message' => 'Therapist assigned successfully and email notification sent.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        // Validate appointment data
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:users,id',
            'therapist_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:menus,id', // Updated to use menu instead of service
            'appointment_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        // Create the new appointment
        Appointment::create($request->all());

        return response()->json([
            'message' => 'Appointment created successfully.'
        ], 201);
    }
}

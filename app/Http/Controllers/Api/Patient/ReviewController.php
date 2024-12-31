<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Show the details for creating a review.
     */
    public function create(Appointment $appointment)
    {
        if ($appointment->client_id !== auth()->id()) {
            return response()->json(['message' => 'You are not authorized to review this appointment.'], 403);
        }

        if ($appointment->status !== 'completed') {
            return response()->json(['message' => 'You can only review completed appointments.'], 403);
        }

        if ($appointment->review()->exists()) {
            return response()->json(['message' => 'You have already reviewed this appointment.'], 400);
        }

        return response()->json(['message' => 'You can create a review.', 'appointment' => $appointment], 200);
    }

    /**
     * Store a new review in the database.
     */
    public function store(Request $request, Appointment $appointment)
    {
        if ($appointment->client_id !== auth()->id()) {
            return response()->json(['message' => 'You are not authorized to review this appointment.'], 403);
        }

        if ($appointment->status !== 'completed') {
            return response()->json(['message' => 'You can only review completed appointments.'], 403);
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);

        Review::create([
            'appointment_id' => $appointment->id,
            'client_id' => auth()->id(),
            'clinic_id' => $appointment->clinic_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return response()->json(['message' => 'Thank you for your review!'], 201);
    }
}

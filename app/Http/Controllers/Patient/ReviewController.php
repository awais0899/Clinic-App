<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Show the form for creating a review.
     */
    public function create(Appointment $appointment)
    {
        if ($appointment->client_id !== auth()->id()) {
            abort(403, 'You are not authorized to review this appointment.');
        }

        if ($appointment->status !== 'completed') {
            abort(403, 'You can only review completed appointments.');
        }

        if ($appointment->review()->exists()) {
            return redirect()->route('patient.appointments.index')
                ->with('error', 'You have already reviewed this appointment.');
        }

        return view('patient.reviews.create', compact('appointment'));
    }

    /**
     * Store a new review in the database.
     */
    public function store(Request $request, Appointment $appointment)
    {
        if ($appointment->client_id !== auth()->id()) {
            abort(403, 'You are not authorized to review this appointment.');
        }

        if ($appointment->status !== 'completed') {
            abort(403, 'You can only review completed appointments.');
        }

        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);

        Review::create([
            'appointment_id' => $appointment->id,
            'client_id' => auth()->id(),
            'clinic_id' => $appointment->clinic_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('patient.appointments.index')
            ->with('success', 'Thank you for your review!');
    }
}

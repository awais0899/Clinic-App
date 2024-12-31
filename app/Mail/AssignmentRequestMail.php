<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignmentRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $therapist;
    public $appointment;

    public function __construct(User $therapist, Appointment $appointment)
    {
        $this->therapist = $therapist;
        $this->appointment = $appointment;
    }

    public function build()
    {
        // Use a simple plain text view to test
        return $this->subject('New Appointment Assigned')
            ->markdown('emails.assignment_request')  // Ensure markdown is used here
            ->with([
                'therapist' => $this->therapist,
                'appointment' => $this->appointment,
            ]);

    }
}

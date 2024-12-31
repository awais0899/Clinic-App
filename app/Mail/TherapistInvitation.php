<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TherapistInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public Invitation $invitation;

    /**
     * Create a new message instance.
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('emails.therapist-invitation') // Using markdown for email content
                    ->subject('Invitation to join ' . $this->invitation->clinic->name);
    }
}

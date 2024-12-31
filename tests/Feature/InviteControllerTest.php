<?php

namespace Tests\Feature;

use App\Models\Clinic;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\TherapistInvitation;

class InviteControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_an_invitation_email()
    {
        // Arrange: Create an owner with a role and a clinic associated with them
        $owner = User::factory()->create(['role' => 'owner']);
        $clinic = Clinic::factory()->create(['owner_id' => $owner->id]);

        // Fake the mail facade to prevent actual sending
        Mail::fake();

        // Act: Send the invitation
        $response = $this->actingAs($owner)->post(route('owner.invitations.send', $clinic), [
            'email' => 'therapist@example.com',
        ]);

        // Assert: Check that the invitation is saved in the database
        $this->assertDatabaseHas('invitations', [
            'email' => 'therapist@example.com',
            'clinic_id' => $clinic->id,
            'status' => 'pending',
        ]);

        // Assert: Ensure the email is sent and check the email contents
        Mail::assertSent(TherapistInvitation::class, function ($mail) use ($clinic) {
            // You can dump here if debugging, but usually assertions are sufficient
            // dump($mail->invitation);
            return $mail->invitation->clinic_id === $clinic->id &&
                   $mail->invitation->email === 'therapist@example.com';
        });

        // Assert: Check the response after sending the invitation
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Invitation sent successfully.');
    }
}

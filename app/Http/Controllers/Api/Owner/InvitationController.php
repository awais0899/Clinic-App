<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\TherapistInvitation;

class InvitationController extends Controller
{
    // Display a list of invitations for a given clinic
    public function index(Clinic $clinic)
    {
        $this->authorize('view', $clinic);

        $invitations = $clinic->invitations()->latest()->paginate(10);

        return response()->json([
            'data' => $invitations,
            'message' => 'Invitations fetched successfully.'
        ]);
    }

    // Show the form to create a new invitation
    public function create(Clinic $clinic)
    {
        $this->authorize('view', $clinic);

        return response()->json([
            'message' => 'Ready to create an invitation.'
        ]);
    }

    // Store the new invitation (dynamic role assignment)
    public function store(Request $request, Clinic $clinic)
    {
        $this->authorize('view', $clinic);

        $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => ['required', 'in:therapist,patient'],
        ]);

        // Check if the user has already been invited
        $existingInvitation = $clinic->invitations()->where('email', $request->email)->exists();

        if ($existingInvitation) {
            return response()->json([
                'message' => 'This user has already been invited.',
            ], 400);
        }

        // Create the invitation
        $invitation = $clinic->invitations()->create([
            'email' => $request->email,
            'token' => Str::random(32),
            'role' => $request->role,
            'expires_at' => Carbon::now()->addDays(7),
            'status' => Invitation::STATUS_PENDING, // Set initial status to 'pending'
        ]);

        // Send the invitation email with the token
        Mail::to($request->email)->send(new TherapistInvitation($invitation));

        return response()->json([
            'message' => 'Invitation sent successfully.',
            'data' => $invitation,
        ]);
    }

    // Handle the invitation acceptance (role-based dynamic registration)
    public function acceptInvitation($token)
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation || $invitation->expires_at < Carbon::now()) {
            return response()->json([
                'message' => 'Invitation not found or expired.',
            ], 404);
        }

        // Update the status to 'accepted'
        $invitation->status = Invitation::STATUS_ACCEPTED;
        $invitation->save();

        // Check if the user already exists, if not, create the user
        $user = User::where('email', $invitation->email)->first();

        if (!$user) {
            // Create a new user based on the role
            $user = User::create([
                'email' => $invitation->email,
                'password' => bcrypt(Str::random(12)), // Temporary password, user should change it
                'role' => $invitation->role, // Assign role based on the invitation
            ]);
        }

        // Login the user automatically
        auth()->login($user);

        return response()->json([
            'message' => 'Invitation accepted, and user registered successfully.',
            'data' => $user,
        ]);
    }
}

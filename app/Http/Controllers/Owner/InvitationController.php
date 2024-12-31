<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Mail\TherapistInvitation;
use App\Models\Clinic;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InvitationController extends Controller
{
    // Display a list of invitations for a given clinic
    public function index(Clinic $clinic)
    {
        $this->authorize('view', $clinic);
        $invitations = $clinic->invitations()->latest()->paginate(10);
        return view('owner.invitations.index', compact('clinic', 'invitations'));
    }

    // Show the form to create a new invitation
    public function create(Clinic $clinic)
    {
        $this->authorize('view', $clinic);
        return view('owner.invitations.create', compact('clinic'));
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
            session()->flash('error', 'This user has already been invited.');
            return redirect()->route('owner.clinics.invitations.create', $clinic);
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
    
        session()->flash('success', 'Invitation sent successfully.');
        return redirect()->route('owner.clinics.invitations.index', $clinic);
    }
    

    // Handle the invitation acceptance (role-based dynamic registration)
    public function acceptInvitation($token)
    {
        $invitation = Invitation::where('token', $token)->first();
    
        if (!$invitation || $invitation->expires_at < Carbon::now()) {
            return abort(404, 'Invitation not found or expired.');
        }
    
        // Update the status to 'accepted'
        $invitation->status = Invitation::STATUS_ACCEPTED;
        $invitation->save();
    
        // Redirect to registration page
        return view('auth.accept-invitation', compact('invitation'));
    }
    
}

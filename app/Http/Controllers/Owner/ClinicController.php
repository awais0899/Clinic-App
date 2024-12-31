<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\ClinicRequest;
use App\Models\Category;
use App\Models\Clinic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Appointment;
use App\Models\User;    
use App\Models\Invitation;

class ClinicController extends Controller
{
    public function index()
{
    // Get clinics owned by the authenticated user
    $clinics = auth()->user()->clinics()->with('category')->latest()->get();

    // Get therapists (users with 'therapist' role)
    $therapists = User::where('role', 'therapist')->get();

    // Fetch pending appointments for the clinics owned by the authenticated user
    $pendingAppointments = Appointment::whereIn('clinic_id', $clinics->pluck('id'))
                                      ->where('status', 'pending')
                                      ->get();

    // Fetch pending invitations (assuming you have an 'invitations' table or model)
    $pendingInvitations = Invitation::where('status', 'pending')->get();

    // Pass the data to the view
    return view('owner.dashboard', compact('clinics', 'therapists', 'pendingAppointments', 'pendingInvitations'));
}

    public function create()
    {
        $categories = Category::all();
        return view('owner.clinics.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'working_hours_start' => 'required|date_format:H:i',
            'working_hours_end' => 'required|date_format:H:i',
            'working_days' => 'required|array',
            'working_days.*' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('clinics', 'public');
        }

        $validated['owner_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['name']);
        $validated['working_days'] = json_encode($validated['working_days']);

        $clinic = Clinic::create($validated);
        return redirect()->route('owner.clinics.index')
            ->with('success', 'Clinic created successfully.');
    }

    public function show(Clinic $clinic)
    {
        Gate::authorize('view', $clinic);
        
        $services = $clinic->menu()->with('clinic')->latest()->paginate(10);
        return view('owner.clinics.show', compact('clinic', 'services'));
    }

    public function edit(Clinic $clinic)
    {
        Gate::authorize('update', $clinic);
        $categories = Category::all();
        return view('owner.clinics.edit', compact('clinic', 'categories'));
    }

    public function update(ClinicRequest $request, Clinic $clinic)
    {
        Gate::authorize('update', $clinic);
        
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('image')) {
            if ($clinic->image) {
                Storage::disk('public')->delete($clinic->image);
            }
            $data['image'] = $request->file('image')->store('clinics', 'public');
        }

        $clinic->update($data);

        return redirect()->route('owner.clinics.index')
            ->with('success', 'Clinic updated successfully.');
    }

    public function destroy(Clinic $clinic)
    {
        Gate::authorize('delete', $clinic);

        if ($clinic->image) {
            Storage::disk('public')->delete($clinic->image);
        }

        $clinic->delete();

        return redirect()->route('owner.clinics.index')
            ->with('success', 'Clinic deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Menu;
use App\Services\Appointment\SlotGeneratorService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;

class AppointmentController extends Controller
{
    public function index()
{
    // Fetch appointments for the authenticated user and eager load 'clinic' and 'menu'
    $appointments = auth()->user()->appointments()->with('clinic', 'menu')->latest()->paginate(10);

    // Fetch all clinics for the empty state in the view
    $clinics = Clinic::all();

    return view('appointments.index', compact('appointments', 'clinics'));
}


    public function create(Clinic $clinic)
    {
        // Fetch clinic services and generate available slots
        $services = $clinic->load('menu');
        $slotGenerator = new SlotGeneratorService();
        $availableTimes = $slotGenerator->generateSlots($clinic, now()->format('Y-m-d'));

        // Get client ID (authenticated user)
        $clientId = auth()->id();
        return view('appointments.create', compact('clinic', 'services', 'availableTimes', 'clientId'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'clinic_id' => 'required|exists:clinics,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
        ]);
    
        // Set the client ID to the currently authenticated user
        $validatedData['client_id'] = auth()->id();
    
        // Create the appointment
        $appointment = Appointment::create([
            'clinic_id' => $validatedData['clinic_id'],
            'client_id' => $validatedData['client_id'],
            'service_id' => $validatedData['menu_id'],  // Store the service ID
            'appointment_date' => $validatedData['appointment_date'],
            'time' => $validatedData['appointment_time'],
            'status' => 'pending',
        ]);
    
        // Send confirmation email to the patient
        Mail::to($request->user()->email)->send(new AppointmentConfirmation($appointment));
    
        // Redirect to the appointments page with a success message
        return redirect()->route('patient.appointments.index')
                         ->with('success', 'Your appointment has been successfully booked!');
    }

    public function dashboard()
    {
        // Fetch upcoming and past appointments for the authenticated user
        $upcomingAppointments = auth()->user()->appointments()
            ->where('time', '>', now())
            ->with('clinic', 'menu')
            ->get()
            ->map(function ($appointment) {
                if (!$appointment->menu) {
                    // Fallback service if menu is missing
                    $appointment->menu = (object) ['service_name' => 'No Service Available'];
                }
                return $appointment;
            });

        $pastAppointments = auth()->user()->appointments()
            ->where('time', '<=', now())
            ->with('clinic', 'menu')
            ->get()
            ->map(function ($appointment) {
                if (!$appointment->menu) {
                    // Fallback service if menu is missing
                    $appointment->menu = (object) ['service_name' => 'No Service Available'];
                }
                return $appointment;
            });

        // Fetch all clinics
        $clinics = Clinic::with('menu')->get();

        return view('patient.dashboard', compact('upcomingAppointments', 'pastAppointments', 'clinics'));
    }

    // Method to get available slots for a specific clinic and date
    public function getAvailableSlots(Clinic $clinic, $date)
    {
        // Debug clinic and date
        \Log::info('Clinic ID: ' . $clinic->id);
        \Log::info('Requested Date: ' . $date);
    
        // Check clinic existence
        if (!$clinic) {
            return response()->json(['error' => 'Clinic not found'], 404);
        }
    
        // Validate date format
        if (!Carbon::hasFormat($date, 'Y-m-d')) {
            return response()->json(['error' => 'Invalid date format.'], 400);
        }
    
        // Generate slots using the service
        $slotGenerator = new SlotGeneratorService();
        $availableTimes = $slotGenerator->generateSlots($clinic, $date);
    
        return response()->json([
            'clinic' => $clinic->name,
            'date' => $date,
            'available_slots' => $availableTimes,
        ]);
    }
    
}
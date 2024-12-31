<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\ClinicController;
use App\Http\Controllers\Owner\MenuController;
use App\Http\Controllers\Owner\InvitationController;
use App\Http\Controllers\Therapist\TherapistController;
use App\Http\Controllers\Owner\AppointmentController as OwnerController; 
use App\Http\Controllers\Patient\AppointmentController; 
use App\Http\Controllers\Patient\ReviewController;
// Home Route   
Route::get('/', function() {
    return view('home');
});
Route::get('/about', function() {
    return view('about');
    
});Route::get('/services', function() {
    return view('services');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
    // Default dashboard route that redirects based on role
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        if ($role === 'owner') {
            return app(ClinicController::class)->index();
        } elseif ($role === 'therapist') {
            return redirect()->route('therapist.dashboard'); // Redirect to the therapist dashboard
        } elseif ($role === 'patient') {
            return redirect()->route('patient.dashboard');
        }
    })->name('dashboard');

  // Owner-specific Routes
  Route::prefix('owner')->name('owner.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ClinicController::class, 'index'])->name('dashboard');
    
    Route::resource('clinics', ClinicController::class);
    Route::resource('clinics.menus', MenuController::class);

    // Show the form to create a new invitation
    Route::get('clinics/{clinic}/invitations/create', [InvitationController::class, 'create'])->name('clinics.invitations.create');

    // Store the invitation (send the email)
    Route::post('clinics/{clinic}/invitations', [InvitationController::class, 'store'])->name('clinics.invitations.store');
    
    // Show the invitations list for a specific clinic
    Route::get('clinics/{clinic}/invitations', [InvitationController::class, 'index'])->name('clinics.invitations.index');
    
    // Route to delete an invitation (if needed)
    Route::delete('invitations/{invitation}', [InvitationController::class, 'deleteInvitation'])->name('clinics.invitations.delete');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');

});

    // Patient Routes
    Route::prefix('patient')->name('patient.')->group(function () {
        Route::get('/dashboard', [AppointmentController::class, 'dashboard'])->name('dashboard');
        // Route::post('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
        Route::get('appointments/create/{clinic:slug}', [AppointmentController::class, 'create'])->name('appointment.create');
        Route::post('appointments/store', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::resource('appointments', AppointmentController::class)->only(['index','store']);
    });
    Route::middleware(['auth', 'therapist'])->prefix('therapist')->name('therapist.')->group(function () {
        // Therapist Dashboard
        Route::get('/dashboard', [TherapistController::class, 'index'])->name('dashboard');
        
        // Appointments Routes for Therapists
        Route::post('/appointments/{appointment}/complete', [TherapistController::class, 'markComplete'])->name('appointments.complete');
        Route::post('/appointments/{appointment}/add-diagnosis', [TherapistController::class, 'addDiagnosis'])->name('appointments.addDiagnosis');
        
        // Route for Showing Appointment Details
        Route::get('/appointments/{appointment}', [TherapistController::class, 'show'])->name('appointments.show');
    });
    

    Route::get('/appointments', [AppointmentController::class, 'create'])->name('appointments.create');
});

Route::post('/clinics/{clinic}/appointments', [AppointmentController::class, 'store'])->name('patient.appointments.show');
Route::get('/patient/appointments/{appointment}/reviews/create', [ReviewController::class, 'create'])
    ->name('patient.reviews.create');
    Route::post('/appointments/{appointment}/reviews', [ReviewController::class, 'store'])
    ->name('patient.reviews.store');
    
  Route::get('your-invitation-url/{token}', [InvitationController::class, 'acceptInvitation'])
        ->withoutMiddleware(['auth'])
        ->name('invitation.accept');

// Route::post('/appointments/{appointment}/assign-therapist', [OwnerController::class, 'assignTherapist'])->name('owner.appointments.assignTherapist');
Route::get('/therapists/assignments/accept/{token}', [TherapistController::class, 'acceptAssignment'])
    ->name('therapists.assignments.accept');
Route::patch('/appointments/{appointment}/assignTherapist', [OwnerController::class, 'assignTherapist'])
    ->name('owner.appointments.assignTherapist');
        
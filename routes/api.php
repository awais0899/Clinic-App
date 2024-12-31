<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Owner\AppointmentController;
use App\Http\Controllers\Api\Owner\MenuController;
use App\Http\Controllers\API\Owner\ClinicController;
use App\Http\Controllers\Owner\InvitationController;
use App\Http\Controllers\Api\Patient\ReviewController;
use App\Http\Controllers\API\Therapist\TherapistController;

// Public routes
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

// Protected routes for authenticated users
Route::middleware('auth:sanctum')->group(function () {
    
    // Appointment routes
    Route::get('appointments', [AppointmentController::class, 'index']); // List appointments based on role
    Route::post('appointments', [AppointmentController::class, 'store']); // Create a new appointment
    Route::post('appointments/{appointment}/assign-therapist', [AppointmentController::class, 'assignTherapist']); 
});

Route::middleware(['auth:sanctum'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/clinics', [ClinicController::class, 'index'])->name('clinics.index');
    Route::get('/clinics/create', [ClinicController::class, 'create'])->name('clinics.create');
    Route::post('/clinics', [ClinicController::class, 'store'])->name('clinics.store');
    Route::get('/clinics/{clinic}', [ClinicController::class, 'show'])->name('clinics.show');
    Route::get('/clinics/{clinic}/edit', [ClinicController::class, 'edit'])->name('clinics.edit');
    Route::put('/clinics/{clinic}', [ClinicController::class, 'update'])->name('clinics.update');
    Route::delete('/clinics/{clinic}', [ClinicController::class, 'destroy'])->name('clinics.destroy');
});

Route::prefix('owner')->middleware('auth:sanctum')->group(function () {
    Route::resource('clinics.menus', MenuController::class);  // or a similar route definition
});

Route::prefix('owner')->middleware('auth:sanctum')->group(function () {
    Route::get('clinics/{clinic}/invitations', [InvitationController::class, 'index'])->name('owner.clinics.invitations.index');
    Route::post('clinics/{clinic}/invitations', [InvitationController::class, 'store'])->name('owner.clinics.invitations.store');
    Route::get('invitations/accept/{token}', [InvitationController::class, 'acceptInvitation'])->name('owner.invitations.accept');
});

// Group routes that require authentication
Route::middleware('auth:sanctum')->prefix('patient')->group(function () {
    Route::get('/appointments/{appointment}/review/create', [ReviewController::class, 'create'])->name('patient.review.create');
    Route::post('/appointments/{appointment}/review', [ReviewController::class, 'store'])->name('patient.review.store');
});


Route::middleware('auth:sanctum')->prefix('therapist')->group(function () {
    Route::get('/dashboard', [TherapistController::class, 'index'])->name('therapist.dashboard'); // Get therapist's appointments
    Route::post('/appointments/{appointment}/complete', [TherapistController::class, 'markComplete'])->name('therapist.appointments.complete'); // Mark appointment as complete
    Route::post('/appointments/{appointment}/diagnosis', [TherapistController::class, 'addDiagnosis'])->name('therapist.appointments.diagnosis'); // Add diagnosis
    Route::get('/appointments/{appointment}', [TherapistController::class, 'show'])->name('therapist.appointments.show'); // Show appointment details
});


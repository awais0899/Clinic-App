<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'clinic_id',
        'therapist_id',
        'client_id',
        'service_id',
        'time',
        'status',
        'notes'
    ];

    protected $casts = [
        'time' => 'datetime', // Ensure the 'time' field is cast as a Carbon instance
    ];

    // Relationships
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // The service for the appointment (menu item)
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'service_id');
    }
    public function review()
    {
        return $this->hasOne(Review::class); 
    }
    
}

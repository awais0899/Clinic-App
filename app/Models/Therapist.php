<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    protected $fillable = [
        'name',
        'email',
        'is_active',
        // Add other relevant fields
    ];

    // Define relationships if necessary
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
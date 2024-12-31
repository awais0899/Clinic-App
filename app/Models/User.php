<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isPatient()
    {
        return $this->role === 'patient';
    }

    public function isTherapist()
    {
        return $this->role === 'therapist';
    }

    public function isOwner()
    {
        return $this->role === 'owner';
    }
    public function therapistAppointments()
{
    return $this->hasMany(Appointment::class, 'therapist_id');
}

public function clinics()
{
    return $this->hasMany(Clinic::class, 'owner_id');
}

public function appointments()
{
    return $this->hasMany(Appointment::class, 'client_id');
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'token', 'clinic_id', 'role', 'expires_at', 'status',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_EXPIRED = 'expired';
    // const STATUS_REGISTERED = 'registered';

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    // Scope to get invitations by status
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', self::STATUS_ACCEPTED);
    }

    public function scopeExpired($query)
    {
        return $query->where('status', self::STATUS_EXPIRED);
    }

    // public function scopeRegistered($query)
    // {
    //     return $query->where('status', self::STATUS_REGISTERED);
    // }
}

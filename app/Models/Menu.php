<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'clinic_id',
        'service_name',
        'description',
        'price',
        'duration',
        'image',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'integer',
        'is_active' => 'boolean',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
}
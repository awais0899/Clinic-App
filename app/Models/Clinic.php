<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{

    use HasFactory;
    protected $fillable = [
        'category_id',
        'owner_id',
        'name',
        'slug',
        'description',
        'address',
        'phone',
        'email',
        'working_hours_start',
        'working_hours_end',
        'working_days',
        'is_active',
        'image'
    ];

    protected $casts = [
        'working_days' => 'array',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

  // Clinic.php (Model)
public function menu()
{
    return $this->hasMany(Menu::class);
}

public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
// Clinic.php (Model)
public function therapists()
{
    return $this->hasMany(Therapist::class);  
}
 public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $guarded = ['id']; // Allows all fields to be mass-assigned securely
    
    // Cast the deadline to a proper date object automatically
    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];
}
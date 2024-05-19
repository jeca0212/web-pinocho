<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'people',
        'date',
        'phone',
        'email',
        'time',
        'allergies',
        'score',
        'status',
        
    ];

    // Agrega este método para establecer la relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

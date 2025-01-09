<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'first_name',
        'gender',
        'date_of_birth',
        'age',
        'phone',
        'email',
        'address',
        'blood_group',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
    

}

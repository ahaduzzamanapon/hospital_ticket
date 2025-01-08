<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'head_of_department',
        'phone',
        'fees',
        'room_number',
        'total_slot'
    ];

    public $timestamps = true;

    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }

}

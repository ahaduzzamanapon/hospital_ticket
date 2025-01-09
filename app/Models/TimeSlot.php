<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'time_slot',
        'department_id',
        'total_ticket'
    ];

    public $timestamps = true;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    protected $casts = [
        'date' => 'datetime',
    ];
    

}

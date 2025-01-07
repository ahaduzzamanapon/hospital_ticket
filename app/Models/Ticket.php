<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'patient_id',
        'department_id',
        'time_slot_id',
        'date',
        'payment_amount',
        'payment_status',
        'transection_id'
    ];
}

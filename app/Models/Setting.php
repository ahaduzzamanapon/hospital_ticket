<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'title_bn',
        'title_en',
        'logo',
        'favicon',
        'address_bn',
        'address_en',
    ];

    public $timestamps = true;

}

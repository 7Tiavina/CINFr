<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['session_data', 'stripe_session_id'];
    protected $casts = [
        'session_data' => 'array',  // cast JSON → tableau PHP
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
   protected $fillable = [
      'session_data',
      'email',
      'stripe_session_id',
      'receipt_url',
      'charge_id',
    ];
    protected $casts = [
        'session_data' => 'array',  // cast JSON → tableau PHP
    ];
}



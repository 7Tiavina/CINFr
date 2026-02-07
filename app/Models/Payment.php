<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
    protected $fillable = [
      'client_id','stripe_session_id','charge_id','receipt_url',
      'card_last4','email','amount','currency','status','payment_method', 'payment_status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

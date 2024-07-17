<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'method_id',
        'total_bayar',
    ];

    function order()
    {
        return $this->belongsTo(Order::class);
    }

    function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'method_id');
    }
}

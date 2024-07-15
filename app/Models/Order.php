<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status',
        'total_payment',
        'payment_id',
    ];

    function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    function payment()
    {
        return $this->belongsTo(Customer::class, 'payment_id');
    }
}

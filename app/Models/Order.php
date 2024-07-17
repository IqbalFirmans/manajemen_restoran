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
    ];

    function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    function payment()
    {
        return $this->hasOne(Payment::class);
    }

    function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

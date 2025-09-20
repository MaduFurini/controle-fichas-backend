<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_products';

    protected $fillable = [
        'event_product_id',
        'order_id',
        'quantity',
        'unity_value',
    ];

    public function eventProduct()
    {
        return $this->belongsTo(EventProduct::class, 'event_product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}

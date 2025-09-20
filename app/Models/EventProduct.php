<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventProduct extends Model
{
    use HasFactory;

    protected $table = 'event_products';

    protected $fillable = [
        'event_id',
        'product_id',
        'price',
        'observation',
        'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

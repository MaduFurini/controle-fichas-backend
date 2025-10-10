<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventProduct extends Model
{
    use HasFactory;

    protected $table = 'event_products';

    protected $fillable = [
        'uuid',
        'event_id',
        'product_id',
        'price',
        'observation',
        'status',
    ];

    protected $hidden = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

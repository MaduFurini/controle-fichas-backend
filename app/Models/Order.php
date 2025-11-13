<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'uuid',
        'community_id',
        'payment_type_id',
        'session_id',
        'code',
        'total_value',
        'date',
        'status',
    ];

    protected $hidden = ['id'];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
}

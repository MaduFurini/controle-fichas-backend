<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $table = 'payment_types';

    protected $fillable = [
        'community_id',
        'name',
        'status'
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }
}

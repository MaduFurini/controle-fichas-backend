<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Community extends Model
{
    use HasFactory;

    protected $table = 'communities';

    protected $fillable = [
        'uuid',
        'name',
        'street',
        'city',
        'state',
        'number',
        'zip_code',
        'email_responsible',
        'phone',
        'image',
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $table = 'communities';

    protected $fillable = [
        'name',
        'type',
        'street',
        'number',
        'zip_code',
        'email_responsible',
        'phone',
        'image',
        'status',
    ];
}

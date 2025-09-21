<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'community_id',
        'name',
        'code',
        'email',
        'password',
        'recovery_code',
        'access_type',
        'status',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }
}

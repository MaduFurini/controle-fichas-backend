<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'uuid',
        'community_id',
        'name',
        'code',
        'email',
        'password',
        'recovery_code',
        'access_type',
        'status',
    ];

    protected $hidden = ['id', 'recovery_code'];

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
}

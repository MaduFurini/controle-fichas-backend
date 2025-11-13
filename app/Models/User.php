<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    protected $hidden = ['id', 'recovery_code', 'password'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function setPasswordAttribute(?string $value): void
    {
        if (is_null($value) || $value === '') {
            $this->attributes['password'] = $value;
            return;
        }

        if (Str::startsWith($value, ['$2y$', '$argon2i$', '$argon2id$'])) {
            $this->attributes['password'] = $value;
            return;
        }

        $this->attributes['password'] = Hash::make($value);
    }

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }
}

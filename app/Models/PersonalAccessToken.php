<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory;

    protected $table = 'personal_access_tokens';

    protected $fillable = [
        'community_id',
        'reference_id',
        'module',
        'token',
        'expires_at',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }
}

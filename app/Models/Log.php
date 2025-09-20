<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'community_id',
        'user_id',
        'action',
        'module',
        'description',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

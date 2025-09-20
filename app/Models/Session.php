<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions';

    protected $fillable = [
        'community_id',
        'user_id',
        'event_id',
        'date',
        'entry_time',
        'exit_time',
        'entry_value',
        'exit_value',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'community_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }
}

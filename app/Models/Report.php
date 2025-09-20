<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'community_id',
        'event_id',
        'name',
        'description',
        'file',
        'date',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

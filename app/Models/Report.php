<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'uuid',
        'community_id',
        'event_id',
        'name',
        'description',
        'file',
        'date',
    ];

    protected $hidden = ['id'];

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

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

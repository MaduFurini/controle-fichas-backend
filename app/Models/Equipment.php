<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    protected $fillable = [
        'community_id',
        'name',
        'identification_tag',
        'description',
        'status',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }
}

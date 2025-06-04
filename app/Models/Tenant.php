<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'plan',
        'expires_at',
    ];

    protected $dates = ['expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPosUrlAttribute()
    {
        return 'https://' . $this->slug . 'bloommonie.com';
    }

    public function isActive()
    {
        return now()->lt($this->expires_at);
    }
}

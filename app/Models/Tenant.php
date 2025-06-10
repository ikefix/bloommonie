<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    // Fillable fields example (adjust as per your migration)
    protected $fillable = [
        'name',
        'domain',
        // other tenant-specific fields
    ];

    // One tenant has many users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

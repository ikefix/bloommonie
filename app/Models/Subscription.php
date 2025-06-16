<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'plan', 'amount', 'payment_reference', 'starts_at', 'ends_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

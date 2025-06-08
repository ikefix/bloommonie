<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'company_phone',
        'company_name',
        'num_employees',
        'annual_revenue',
        'industry',
        'custom_industry',
        'current_inventory_system',
        'current_inventory_system_other',
        'country',
        'state',
        'city',
        'role',
        'shop_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // POS relationships
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function stockTransfers()
    {
        return $this->hasMany(StockTransfer::class, 'to_shop_id');
    }
}

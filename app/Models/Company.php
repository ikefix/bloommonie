<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'companies';

    // Specify which fields are mass assignable
    protected $fillable = [
        'name',
        'email',
        'phonenumber',
        'password',
        'companyname',
        'employees',
        'revenue',
        'industry',
        'inventory',
        'country',
        'state',
        'city',
    ];

    protected $hidden = ['password'];

}

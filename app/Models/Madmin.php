<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Madmin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'madmin';

    protected $fillable = [
        'name', 'email', 'password','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

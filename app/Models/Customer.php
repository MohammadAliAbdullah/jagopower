<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'mypanel';

    protected $fillable = [
        'name','phone', 'email', 'password', 'address', 'virification','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

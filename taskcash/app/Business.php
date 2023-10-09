<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Business extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'status', 'image'
    ];

    protected $hidden = [
        'password',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Task', 'business_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction', 'business_id');
    }
}

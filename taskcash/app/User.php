<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $with = ['requests', 'wallet', 'jobs'];
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'firebase', 'status'
    ];

    protected $hidden = [
        'password',
    ];

    public function requests()
    {
        return $this->hasMany('App\UserRequest');
    }
    
    public function jobs()
    {
        return $this->hasMany('App\TaskCompleted');
    }

    public function wallet()
    {
        return $this->hasOne('App\Wallet')->withDefault([
            'amount'=> 0
        ]);
    }

}

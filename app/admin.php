<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class admin extends Authenticatable
{
    use HasFactory;
    protected $table='admin';
    protected $fillable=[
        'id', 'name', 'email', 'password', 'phone', 'address', 'profile_image', 'created_at', 'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buyer extends Model
{
    use HasFactory;
    protected $table='buyer';
    protected $fillable=[
        'id', 'name','cnic', 'email', 'phone', 'address', 'buyer_image', 'created_at', 'updated_at'
    ];
}

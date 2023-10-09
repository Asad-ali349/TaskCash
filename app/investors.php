<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class investors extends Model
{
    use HasFactory;
    protected $table='investors';
    protected $fillable=[
        'id', 'name','cnic', 'email', 'phone', 'address', 'created_at', 'updated_at'
    ];

    public function investment()
    {
        return $this->hasMany('App\Models\property_investment');
    }
}

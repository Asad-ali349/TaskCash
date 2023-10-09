<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property_gallery extends Model
{
    use HasFactory;
    protected $table='property_gallery';
    protected $fillable=[
        'id', 'property_image', 'property_id', 'created_at', 'updated_at'
    ];
}

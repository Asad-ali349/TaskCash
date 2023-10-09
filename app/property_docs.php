<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property_docs extends Model
{
    use HasFactory;
    protected $table='property_docs';
    protected $fillable=[
        'id', 'property_id', 'document', 'created_at', 'updated_at'
    ];
}

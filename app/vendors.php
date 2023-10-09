<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendors extends Model
{
    use HasFactory;
    protected $table='vendors';
    protected $fillable=[
        'id', 'name', 'email', 'phone', 'vendor_type', 'address', 'created_at', 'updated_at'
    ];
    public function service_type()
    {
        return $this->belongsTo(service_type::class,'vendor_type');
    }
}

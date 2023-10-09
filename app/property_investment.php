<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property_investment extends Model
{
    use HasFactory;
    protected $table='property_investment';
    protected $fillable=[
        'id', 'property_id','investors_id', 'investment_amount', 'created_at', 'updated_at'
    ];

    public function investor()
    {
        return $this->belongsTo(investors::class,'investors_id');
    }
    public function property()
    {
        return $this->belongsTo(property::class,'property_id');
    }
}

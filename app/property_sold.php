<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property_sold extends Model
{
    use HasFactory;
    protected $table='property_sold';
    protected $fillable=[
        'id', 'property_id', 'buyer_id', 'sold_date', 'sold_amount', 'amount_received', 'amount_pending', 'sold_type', 'created_at', 'updated_at'
    ];

    public function property()
    {
        return $this->belongsTo(property::class,'property_id');
    }
    public function buyer()
    {
        return $this->belongsTo(buyer::class,'buyer_id');
    }
    public function invoices()
    {
        return $this->hasMany('App\Models\invoices');
    }
}

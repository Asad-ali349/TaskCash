<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property_expenses extends Model
{
    use HasFactory;
    protected $table='property_expenses';
    protected $fillable=[
        'id', 'name', 'service_type', 'expense_date', 'amount', 'property_id', 'vendor_id', 'description', 'created_at', 'updated_at'
    ];
    public function vendor()
    {
        return $this->belongsTo(vendors::class,'vendor_id');
    }
    public function expense_docs()
    {
        return $this->hasMany('App\Models\expense_docs');
    }
    public function property()
    {
        return $this->belongsTo(property::class,'property_id');
    }
}

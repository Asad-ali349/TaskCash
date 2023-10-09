<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property extends Model
{
    use HasFactory;
    protected $table='property';
    protected $fillable=[
        'id','property_address','property_type', 'property_image', 'num_of_marla', 'sq_feet', 'purchased_amount', 'sale_amount', 'purchased_date', 'created_at', 'updated_at'
    ];



    public function gallery()
    {
        return $this->hasMany('App\Models\property_gallery');
    }
    public function docs()
    {
        return $this->hasMany('App\Models\property_docs');
    }
    public function expense()
    {
        return $this->hasMany('App\Models\property_expenses');
    }
    public function investment()
    {
        return $this->hasMany('App\Models\property_investment');
    }
}

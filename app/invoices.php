<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    use HasFactory;
    protected $table='invoices';
    protected $fillable=[
        'id', 'property_sold_id', 'due_amount', 'received_amount', 'due_date', 'paid_date','status', 'created_at', 'updated_at'
    ];
}

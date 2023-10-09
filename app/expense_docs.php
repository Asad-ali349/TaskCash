<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense_docs extends Model
{
    use HasFactory;
    protected $table='expense_docs';
    protected $fillable=[
        'id', 'property_expenses_id', 'doc_name', 'document', 'created_at', 'updated_at'
    ];
}

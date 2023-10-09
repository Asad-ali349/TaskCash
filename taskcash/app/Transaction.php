<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'business_id', 'task_id', 'amount', 'transaction_id',
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisputeChat extends Model
{
    protected $fillable = [
        'dispute_id', 'message', 'sent_by', // 'status', 'sender' ,'receiver',
    ];

    // public function sender()
    // {
    //     return $this->belongsTo('')
    // }
}

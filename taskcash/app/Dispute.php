<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    protected $with = ['task'];
    protected $fillable = [
        'title', 'message', 'task_id' ,'reply', 'status',
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function chats()
    {
        return $this->hasMany('App\DisputeChat');
    }

}

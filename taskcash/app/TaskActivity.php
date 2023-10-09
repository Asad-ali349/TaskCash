<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskActivity extends Model
{
    // protected $with = ['act'];
    protected $fillable = [
        'activity_id', 'task_id', 'number_of_act'
    ];

    public function act()
    {
        return $this->belongsTo('App\Activity', 'activity_id');
    }
}

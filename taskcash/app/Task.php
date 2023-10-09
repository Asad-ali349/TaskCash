<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'business_id', 'description', 'category_id', 'status', 'completed', 'link', 'till'
    ];

    protected $dates = ['till'];
    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function transaction()
    {
        return $this->hasOne('App\Transaction');
    }

    public function activities()
    {
        return $this->hasMany('App\TaskActivity');
    }

    public function jobs()
    {
        return $this->hasMany('App\TaskCompleted');
    }

    public function disputes()
    {
        return $this->hasMany('App\Dispute');
    }

    
}

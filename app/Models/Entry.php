<?php

namespace App\Models;

class Entry extends Base
{
    public $timestamps = false;
    
    protected $table = 'entries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place', 
        'comments', 
        'user_id', 
        'img_url'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

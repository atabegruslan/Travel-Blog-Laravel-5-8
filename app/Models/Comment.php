<?php

namespace App\Models;

use App\Models\Traits\LogTrait;

class Comment extends Base
{
    use LogTrait;
    
    public $timestamps = false;
    
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entry_id', 
        'contents', 
        'commentor_id', 
    ];

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}

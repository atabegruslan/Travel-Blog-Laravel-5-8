<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LogTrait;

class Comment extends Model
{// @todo make this able to extend App\Models\Base and utilize log
    //use LogTrait;
    
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

    public function commentor()
    {
        return $this->belongsTo(User::class);
    }
}

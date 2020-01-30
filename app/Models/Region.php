<?php

namespace App\Models;

use App\Models\Traits\LogTrait;

class Region extends Base
{
    use LogTrait;
    
    public $timestamps = false;
    
    protected $table = 'regions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    ];

    public function places()
    {
        return $this->belongsToMany(Entry::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Base
{
    use SoftDeletes;

    public $timestamps = true;
    
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

    public function regionTree()
    {
        return $this->belongsTo(
            RegionTree::class,
            'id',
            'region_id'
        );
    }
}

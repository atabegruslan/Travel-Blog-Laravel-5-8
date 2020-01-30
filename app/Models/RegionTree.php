<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionTree extends Model
{
    public $timestamps = false;
    
    protected $table = 'region_tree';

    protected $fillable = [
        'region_id',
        'parent_id',
    ];
}

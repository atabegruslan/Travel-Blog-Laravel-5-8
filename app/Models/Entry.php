<?php

namespace App\Models;

use App\Models\Traits\LogTrait;

class Entry extends Base
{
    use LogTrait;
    
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
        return $this->belongsTo(User::class);
    }

    public function regions()
    {
// https://laravel.com/api/5.6/Illuminate/Database/Eloquent/Concerns/HasRelationships.html
        return $this->belongsToMany(
            Region::class,
            'entry_region',
            'place_id',
            'region_id',
        );
    }
}

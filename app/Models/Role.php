<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public $guard_name = 'api';

    protected $appends = [
        'permissions'
    ];

    public function getPermissionsAttribute()
    {
        return $this->permissions()->pluck('name');
    }
}

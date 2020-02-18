<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class SyncPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Reset cached roles and permissions.
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions.
        $permissions = config('permission.features');

        foreach (['web'/*, 'api'*/] as $guard) 
        {
            foreach ($permissions as $feature => $permissionList) 
            {
                $hasChild = array_filter($permissionList, 'is_array');

                if (count($hasChild)) 
                {
                    foreach ($permissionList as $child => $permissionListChild) 
                    {
                        $this->insertPermissions($permissionListChild, $guard);
                    }

                    continue;
                }

                $this->insertPermissions($permissionList, $guard);
            }
        }
    }

    protected function insertPermissions($data, $guard)
    {
        $insertData = collect($data)->transform(function ($item) use ($guard) 
        {
            return [
                'name'       => $item,
                'guard_name' => $guard,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        Permission::query()->insert($insertData);
    }
}

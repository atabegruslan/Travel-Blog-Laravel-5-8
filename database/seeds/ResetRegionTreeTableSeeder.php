<?php

use Illuminate\Database\Seeder;

class ResetRegionTreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('region_tree')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $regionIds = DB::table('regions')
            ->pluck('id')
            ->toArray();

        $defaultTree = [];

        foreach ($regionIds as $regionId) 
        {
            $defaultTree[] = ['region_id' => $regionId, 'parent_id' => 0];
        }

        DB::table('region_tree')->insert($defaultTree);
    }
}

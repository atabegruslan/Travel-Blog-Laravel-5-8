<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRegionTreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('region_tree')) {
            Schema::create('region_tree', function (Blueprint $table) {
                $table->integer('region_id');
                $table->integer('parent_id');
            });

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_tree');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('entries')) {
            Schema::create('entries', function (Blueprint $table) {
                $table->increments('id');
                $table->string('place', 15);
                $table->string('comments', 50);
                $table->string('img_url', 500)->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->timestamp('time')->useCurrent();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}

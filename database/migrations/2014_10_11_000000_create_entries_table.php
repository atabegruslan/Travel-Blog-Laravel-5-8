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
                $table->softDeletes();
                $table->timestamps();

                // https://stackoverflow.com/questions/26437342/laravel-migration-best-way-to-add-foreign-key
                // https://stackoverflow.com/questions/33819703/is-there-a-way-to-specify-a-name-for-foreign-constraints-in-the-schema-builder-o
                $table->foreign('user_id', 'user_entry')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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

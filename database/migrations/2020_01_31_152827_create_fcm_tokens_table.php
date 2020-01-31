<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFcmTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('fcm_tokens')) {
            Schema::create('fcm_tokens', function (Blueprint $table) {
                $table->increments('id');
                $table->string('token', 300);
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
        Schema::dropIfExists('fcm_tokens');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialColumnsIntoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'type'))
            {
                $table->string('type', 10)->default('normal');
            }
            if (!Schema::hasColumn('users', 'social_id'))
            {
                $table->string('social_id', 500)->nullable();
            }
// https://gist.github.com/Razoxane/3bc74900b4eb5c983eb0927fa13b95f5
// composer require doctrine/dbal
// https://stackoverflow.com/questions/45882990/how-can-indexes-be-checked-if-they-exist-in-a-laravel-migration
            if(array_key_exists("users_email_unique", Schema::getConnection()->getDoctrineSchemaManager()->listTableIndexes('users')))
            {
                $table->dropUnique("users_email_unique");
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'type'))
            {
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('users', 'social_id'))
            {
                $table->dropColumn('social_id');
            }

            if(!array_key_exists("users_email_unique", Schema::getConnection()->getDoctrineSchemaManager()->listTableIndexes('users')))
            {
                $table->unique('email');
            }
        });
    }
}

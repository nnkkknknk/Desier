<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUsersTableProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('icon_file_name')->nullable()->change();
            $table->string('icon_file_path')->nullable()->change();
            $table->string('self_information')->nullable()->change();
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
            //
            $table->string('icon_file_name')->nullable(false)->change();
            $table->string('icon_file_path')->nullable(false)->change();
            $table->string('self_information')->nullable(false)->change();
        });
    }
}

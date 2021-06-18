<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_image', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('work_id');
            $table->string("file_name");
			$table->string("file_path");
            $table->timestamps();
            // 外部キー制約
            $table->foreign('work_id')->references('id')->on('works');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upload_image');
    }
}

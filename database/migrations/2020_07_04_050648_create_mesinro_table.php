<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesinroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesinro', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->enum('tandon',['full', 'kosong']);
            $table->integer('Ph');
            $table->integer('feed');
            $table->integer('catridge');
            $table->integer('membran');
            $table->integer('permate');
            $table->integer('reject');
            $table->enum('catridge_status',['baik', 'replace']);
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesinro');
    }
}

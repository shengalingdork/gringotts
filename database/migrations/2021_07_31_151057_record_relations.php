<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecordRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('record_relations', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('record_id');
        $table->unsignedInteger('related_record_id');
        $table->timestamps();
        $table->foreign('record_id')
          ->references('id')->on('records')
          ->onDelete('cascade');
        $table->foreign('related_record_id')
          ->references('id')->on('records')
          ->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('record_relations');
    }
}

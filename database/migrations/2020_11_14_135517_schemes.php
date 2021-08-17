<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Schemes extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('schemes', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('scheme_group_id');
      $table->unsignedInteger('category_id');
      $table->string('item');
      $table->float('cost', 8, 2);
      $table->float('balance', 8, 2);
      $table->dateTime('start_at');
      $table->dateTime('end_at')->nullable();
      $table->foreign('scheme_group_id')
        ->references('id')->on('scheme_groups')
        ->onDelete('cascade');
      $table->foreign('category_id')
        ->references('id')->on('categories')
        ->onDelete('cascade');
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
    Schema::dropIfExists('schemes');
  }
}

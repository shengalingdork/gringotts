<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Records extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('records', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('category_id')->nullable();
      $table->unsignedInteger('scheme_id')->nullable();
      $table->string('item')->nullable();
      $table->float('cost', 8, 2);
      $table->dateTime('recorded_at');
      $table->foreign('category_id')
        ->references('id')->on('categories')
        ->onDelete('cascade');
      $table->foreign('scheme_id')
        ->references('id')->on('schemes')
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
    Schema::dropIfExists('records');
  }
}

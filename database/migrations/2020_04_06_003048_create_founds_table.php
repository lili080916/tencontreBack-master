<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('founds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
            $table->double('longitude', 15, 8);
            $table->double('latitude', 15, 8);
            $table->bigInteger('quantity')->default(1);
            $table->enum('status', ['Active', 'Doubt', 'Disabled'])->defatul('Active');
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('first');
            $table->dateTime('last');
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
        Schema::dropIfExists('founds');
    }
}

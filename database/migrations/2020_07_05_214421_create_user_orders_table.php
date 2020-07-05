<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('pagseguro_code');
            $table->tinyinteger('pagseguro_status');
            $table->json('items');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_orders');
    }
}

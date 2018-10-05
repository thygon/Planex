<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->text('cart');
            $table->text('address');
            $table->string('name');
            $table->date('from');
            $table->date('to');
            $table->integer('status')->default(0); 
            //0 for not payed
            //1 for payed
            //2 for pending shipment
            //3 for  shipping
            //4 for confirmed
            //5 for rejected
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

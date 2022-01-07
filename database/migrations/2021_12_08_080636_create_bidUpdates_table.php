<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidUpdatesTable extends Migration
{
   
    public function up()
    {
        Schema::create('bidUpdates', function (Blueprint $table) {
            $table->id();
            $table->float('price', 19, 2);
            $table->string('description');
            $table->foreignId('bid_id')
                ->nullable()
                ->references('id')
                ->on('bids')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('bidUpdates');
    }
}

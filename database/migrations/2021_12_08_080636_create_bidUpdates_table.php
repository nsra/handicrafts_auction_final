<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidupdatesTable extends Migration
{
   
    public function up()
    {
        Schema::create('bidupdates', function (Blueprint $table) {
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
        Schema::dropIfExists('bidupdates');
    }
}

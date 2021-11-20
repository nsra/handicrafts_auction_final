<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('products', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title')->unique();
        //     $table->longText('description');
        //     $table->foreignId('category_id')
        //         ->references('id')
        //         ->on('categories')
        //         ->onDelete('cascade');
        //     $table->integer('bidIncreament');
        //     $table->float('orderNowPrice', 19, 2);
        //     $table->tinyInteger('is_delete')->default(0);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('products');
    }
}

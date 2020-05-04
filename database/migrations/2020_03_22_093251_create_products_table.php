<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('slug');
            $table->integer('stock')->default(1);
            $table->decimal('price', 5, 2);
            $table->longText('description');
            $table->json('gallery')->default(new Expression('(JSON_ARRAY())'));
            $table->integer('orders');
            $table->unsignedBigInteger('seller')->nullable()->unsigned();
            $table->unsignedBigInteger('categories_id')->nullable()->unsigned();
            $table->unsignedBigInteger('sub_categories_id')->nullable()->unsigned();

            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub_categories_id')->references('id')->on('sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('seller')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}

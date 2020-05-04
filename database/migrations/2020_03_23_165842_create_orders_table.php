<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
            $table->bigIncrements('order_id')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->jsonb('products')->nullable()->default(new Expression('(JSON_ARRAY())'));
            $table->unsignedBigInteger('address_id')->nullable();
            $table->boolean('confirmed')->nullable()->default(false);
            $table->boolean('status')->nullable()->default(false);
            $table->integer('tracker')->nullable()->default(1);
            $table->mediumText('hash')->nullable();
            $table->dateTime('placed_date')->nullable()->default(Carbon::now());
            $table->dateTime('last_update_date')->nullable()->default(Carbon::now());
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('order_product_id');
            $table->bigInteger('fk_order_id')->unsigned();

            $table->foreign('fk_order_id')
                ->references('order_id')
                ->on('orders')
                ->onDelete('cascade');

            $table->string('item_name');
            $table->decimal('normal_price', 10, 2)->default(0);
            $table->decimal('promotion_price', 10, 2)->default(0);
            $table->timestamps();
        });

        DB::update("ALTER TABLE order_products AUTO_INCREMENT = 2000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropForeign('order_products_fk_order_id_foreign');
        });

        Schema::dropIfExists('order_products');
    }
}

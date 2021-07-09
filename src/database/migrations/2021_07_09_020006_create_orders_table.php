<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->bigIncrements('order_id');
            $table->string('sales_type');
            $table->timestamp('order_date');
            $table->string('status')->default('pending');
            $table->bigInteger('fk_customer_id')->unsigned()->nullable();
            $table->decimal('order_total', 10, 2)->default(0.00);
            $table->foreign('fk_customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('set null');
            $table->timestamps();
        });

        DB::update("ALTER TABLE orders AUTO_INCREMENT = 1001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_fk_customer_id_foreign');
        });

        Schema::dropIfExists('orders');
    }
}

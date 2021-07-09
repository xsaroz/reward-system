<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrderRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_order_rewards', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('fk_customer_id')->unsigned();
            $table->foreign('fk_customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');

            $table->bigInteger('fk_order_id')->unsigned();
            $table->foreign('fk_order_id')
                ->references('order_id')
                ->on('orders')
                ->onDelete('cascade');

            $table->decimal('reward_amount', 10, 2)->default(0.00);
            $table->integer('reward_point')->default(0);
            $table->timestamp('expiry_date');

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
        Schema::table('customer_order_rewards', function (Blueprint $table) {
            $table->dropForeign('customer_order_rewards_fk_customer_id_foreign');
            $table->dropForeign('customer_order_rewards_fk_order_id_foreign');
        });

        Schema::dropIfExists('customer_order_rewards');
    }
}

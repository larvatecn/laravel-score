<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_recharges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->comment('用户ID');
            $table->string('channel', 10)->comment('付款渠道');
            $table->string('type', 10)->comment('付款类型');
            $table->unsignedInteger('amount')->default(0)->comment('付款金额');
            $table->unsignedInteger('score')->default(0)->comment('可得积分数');
            $table->ipAddress('client_ip')->nullable()->comment('客户端IP');
            $table->string('status', 10)->default(\Larva\Score\Models\Recharge::STATUS_PENDING)->comment('状态');
            $table->timestamp('succeeded_at', 0)->nullable()->comment('成功时间');
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
        Schema::dropIfExists('score_recharges');
    }
}

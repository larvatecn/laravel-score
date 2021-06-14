<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_bonus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('paid')->comment('是否已经赠送');
            $table->unsignedBigInteger('user_id')->comment('用户ID');
            $table->unsignedInteger('score')->comment('赠送的积分数');
            $table->nullableMorphs('source');//关联对象
            $table->string('description', 60)->nullable()->comment('描述');
            $table->string('transaction_id')->nullable()->comment('流水ID');
            $table->text('metadata')->nullable()->comment(' 数组，一些源数据');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_bonus');
    }
}

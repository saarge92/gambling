<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeRewardLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_reward_limits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_type_reward')->unsigned();
            $table->bigInteger('count')->default(3);

            $table->foreign('id_type_reward')->on('type_rewards')->references('id')
                ->onDelete('NO ACTION')->onUpdate('CASCADE');

            $table->softDeletes();
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
        Schema::dropIfExists('type_reward_limits');
    }
}

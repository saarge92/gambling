<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyRewardCofficientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_reward_cofficients', function (Blueprint $table) {
            $table->bigInteger('type_reward_from_id')->unsigned();
            $table->bigInteger('type_reward_to_id')->unsigned();
            $table->bigInteger('coefficient')->default(1);

            $table->foreign('type_reward_from_id')->references('id')
                ->on('type_rewards')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('type_reward_to_id')->references('id')
                ->on('type_rewards')->onUpdate('CASCADE')->onDelete('NO ACTION');

            $table->primary(['type_reward_from_id', 'type_reward_to_id'],'reward_id_primary');

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
        Schema::dropIfExists('money_reward_cofficients');
    }
}

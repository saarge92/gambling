<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeRewardSeeder::class);
        $this->call(RewardSeeder::class);
        $this->call(CoefficientSeeder::class);
    }
}

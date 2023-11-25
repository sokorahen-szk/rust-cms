<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClanModel;

class ClanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClanModel::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\TagModel;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TagModel::factory()->count(10)->create();
    }
}

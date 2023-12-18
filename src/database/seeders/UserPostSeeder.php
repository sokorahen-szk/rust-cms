<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPostModel;

class UserPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserPostModel::factory()->count(20)->create();
    }
}

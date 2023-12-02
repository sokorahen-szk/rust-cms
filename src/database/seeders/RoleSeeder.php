<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleModel;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleModel::factory()->create();

        RoleModel::create([
            "id" => (string) Str::uuid(),
            "name" => "メンバーデフォルト権限",
            "permission" => "MEMBER",
            "permission_level" => 0x123456789,
            "default_permission" => "DEFAULT",
        ]);
    }
}

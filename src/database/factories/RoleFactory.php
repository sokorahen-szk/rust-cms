<?php

namespace Database\Factories;

use App\Models\RoleModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoleFactory extends Factory
{
    protected $model = RoleModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "id" => (string) Str::uuid(),
            "permission" => 0x123456789,
            "description" => "this is user role",
        ];
    }
}

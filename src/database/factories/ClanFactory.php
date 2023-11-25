<?php

namespace Database\Factories;

use App\Models\ClanModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClanFactory extends Factory
{
    protected $model = ClanModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->create();
        return [
            "id" => (string) Str::uuid(),
            "name" => fake()->country(),
            "image_url" => "hogehoge.jpg",
            "introduction" => fake()->text(),
            "created_user_id" => $user->id,
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}

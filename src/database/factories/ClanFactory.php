<?php

namespace Database\Factories;

use App\Models\Eloquent\ClanModel;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            "name" => fake()->country(),
        ];
    }
}

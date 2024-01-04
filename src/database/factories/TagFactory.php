<?php

namespace Database\Factories;

use App\Models\TagModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TagFactory extends Factory
{
    protected $model = TagModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "id" => (string) Str::uuid(),
            "name" => substr(fake()->text(), 5, mt_rand(0, 15)),
            "display_order" => mt_rand(1, 3),
            "is_enabled" => (bool) mt_rand(0, 1),
            "is_enabled" => (bool) mt_rand(0, 1),
            "is_display_on_top" => (bool) mt_rand(0, 1),
        ];
    }
}

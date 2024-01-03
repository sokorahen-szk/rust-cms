<?php

namespace Database\Factories;

use App\Models\UserPostModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserPostFactory extends Factory
{
    protected $model = UserPostModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $platforms = ["PC", "PS4", "Xbox"];

        $categories = [
            "フレンド募集",
            "クランメンバー募集",
            "クランメンバー申請",
            "レイド要員",
            "その他",
        ];
    
        $user = User::factory()->create();

        return [
            "id" => (string) Str::uuid(),
            "platform" => $platforms[mt_rand(0, count($platforms) - 1)],
            "category" => $categories[mt_rand(0, count($categories) - 1)],
            "message" => fake()->text(),
            "is_display_logged_in_user" => mt_rand(0, 1),
            "created_user_id" => $user->id,
            "created_at" => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model"s default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $statuses = ["WAITING", "INACTIVE", "ACTIVE", "WITHDRAWN", "BANNED"];

        return [
            "id" => (string) Str::uuid(),
            "account_id" => "test_user_" . mt_rand(),
            "name" => fake()->name(),
            "status" => $statuses[mt_rand(0, count($statuses) - 1)],
            "role_id" => function () {
                return RoleModel::factory()->create()->id;
            },
            "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", // password
            "created_user_id" => (string) Str::uuid(),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }

    /**
     * Indicate that the model"s email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            "email_verified_at" => null,
        ]);
    }
}

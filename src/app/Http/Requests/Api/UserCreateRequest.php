<?php

namespace App\Http\Requests\Api;

class UserCreateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "account_id" => ["required", "string"],
            "name" => ["required", "string"],
            "email" => ["nullable", "email"],
            "discord_id" => ["nullable", "string"],
            "twitter_id" => ["nullable", "string"],
            "steam_id" => ["nullable", "numeric"],
            "battle_metrics_id" => ["nullable", "numeric"],
            "password" => [
                "required", "string", "required_with:password_confirmation", "same:password_confirmation"
            ],
            "password_confirmation" => ["required", "string"],
            "clan_id" => ["nullable", "string"],
        ];
    }
}

<?php

namespace App\Http\Controllers\Api;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["login"]]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(["account_id", "password"]);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(["error" => "Unauthorized"], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        # This function is used to make JSON response with new
        # access token of current user
        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
            "expires_in" => auth()->factory()->getTTL() * 60
        ]);
    }
}

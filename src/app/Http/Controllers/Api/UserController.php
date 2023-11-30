<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserCreateRequest;
use Illuminate\Http\Request;
use Package\Usecase\User\Command\CreateUserCommand;
use Package\Usecase\User\IUserInteractor;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["store"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest  $request
     * @param  IUserInteractor $interactor
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request, IUserInteractor $interactor)
    {
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), Response::HTTP_BAD_REQUEST);
        }

        $interactor->create(new CreateUserCommand(
            $request->account_id,
            $request->name,
            $request->input("email", null),
            $request->input("discord_id", null),
            $request->input("twitter_id", null),
            $request->input("steam_id", null),
            $request->input("battle_metrics_id", null),
            $request->password,
            $request->input("description", null)
        ));

        return response()->json([]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

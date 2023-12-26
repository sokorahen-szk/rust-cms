<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Package\Usecase\User\IUserPostInteractor;
use App\Http\Controllers\Controller;
use Package\Usecase\User\Command\ListUserPostCommand;
use Symfony\Component\HttpFoundation\Response;

class UserPostController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["index"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, IUserPostInteractor $interactor)
    {
        $user = auth()->user();
        $command = new ListUserPostCommand(
            $user ? true: false,
            $request->input("platforms", null),
            $request->input("sort_key", "created_at#desc"),
            $request->input("limit", null)
        );

        return response()->json($interactor->list($command), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

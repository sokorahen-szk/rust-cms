<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\TagListRequest;
use Package\Usecase\Tag\Command\ListTagCommand;
use Package\Usecase\Tag\ITagInteractor;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["index"]]);
    }

    /**
     * @param TagListRequest $request
     * @param ITagInteractor $interactor
     */
    public function index(TagListRequest $request, ITagInteractor $interactor)
    {
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), Response::HTTP_BAD_REQUEST);
        }

        $command = new ListTagCommand(
            $request->input("is_display_on_top", null)
        );
        return response()->json($interactor->list($command));
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

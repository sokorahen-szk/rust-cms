<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClanCreateRequest;
use App\Http\Requests\Api\ClanUpdateRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Package\Usecase\Clan\Command\CreateClanCommand;
use Package\Usecase\Clan\Command\DeleteClanCommand;
use Package\Usecase\Clan\Command\GetClanCommand;
use Package\Usecase\Clan\Command\ListClanCommand;
use Package\Usecase\Clan\Command\UpdateClanCommand;
use Package\Usecase\Clan\IClanInteractor;

class ClanController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["index", "show"]]);
    }
    /**
     * @param Request $request
     * @param IClanInteractor $interactor
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, IClanInteractor $interactor)
    {
        $command = new ListClanCommand(
            $request->input("ids", []),
            $request->input("tag_ids", []),
            $request->input("keywords", "")
        );

        return response()->json($interactor->list($command));
    }

    /**
     * @param ClanCreateRequest $request
     * @param IClanInteractor $interactor
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClanCreateRequest $request, IClanInteractor $interactor)
    {
        $user = auth()->user();
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), Response::HTTP_BAD_REQUEST);
        }

        $command = new CreateClanCommand(
            $request->name,
            $request->input("image_url", ""),
            $request->input("introduction", ""),
            $user->id,
        );

        $interactor->create($command);
        return response()->json([]);
    }

    /**
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id, IClanInteractor $interactor)
    {
        $command = new GetClanCommand($id);

        return response()->json($interactor->get($command));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClanUpdateRequest  $request
     * @param  string  $id
     * @param  IClanInteractor $interactor
     * @return \Illuminate\Http\Response
     */
    public function update(ClanUpdateRequest $request, string $id, IClanInteractor $interactor)
    {
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), Response::HTTP_BAD_REQUEST);
        }

        $command = new UpdateClanCommand(
            $id,
            $request->input("name", ""),
            $request->input("image_url", ""),
            $request->input("introduction", ""),
        );

        $interactor->update($command);
        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id, IClanInteractor $interactor)
    {
        $command = new DeleteClanCommand($id);
        $interactor->delete($command);
        return response()->json([]);
    }
}

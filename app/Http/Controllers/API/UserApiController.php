<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UsersData;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;

class UserApiController extends Controller
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @OA\Post(
     *      path="/user",
     *      operationId="createUser",
     *      tags={"Пользователь"},
     *      summary="Cоздание пользователя",
     *      security={{"passport": {}}},
     *      description="Создание пользователя",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                   @OA\Property(
     *                      property="name",
     *                      type="string"
     *                   ),
     *                   @OA\Property(
     *                      property="surname",
     *                      type="string"
     *                   ),
     *                   @OA\Property(
     *                      property="email",
     *                      type="string"
     *                   ),
     *                   @OA\Property(
     *                      property="phone",
     *                      type="string"
     *                   ),
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Успешно"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       @OA\Response(response=404, description="Not found"),
     *     )
     *
     * @param UserCreateRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function create(UserCreateRequest $request, User $user)
    {

    }


    public function all(User $user)
    {
        $users = $this->user->get();
        
        return response()->json([
            'data'      =>  UserResource::collection($users),
            'message'   =>  'Список всех пользователей.'
        ]);

    }


    public function getUser($id)
    {
        $user = $this->user->where('id', $id)->first();

        if (is_null($user)) {
            throw new \Exception('Пользователь не найден', 404);
        }

        return response()->json([
            'data'      =>  new UserResource($user),
            'message'   =>  'Пользователь ID:' . $id . ' успешно найден.'
        ]);

    }

    public function getUsersCount()
    {
        $count = $this->user->count();

        return response()->json([
            'data'      =>  [
                'count' => $count
            ],
            'message'   =>  'Количество пользователей.'
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UsersData;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;

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
    public function createUser(UserCreateRequest $request, User $user)
    {
        $data = [
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone')
        ];

        $user = $user->createUser($data);
        
        return $this->sendResponse('Пользователь успешно создан', new UserResource($user), true, 201);
    }



    /**
     * @OA\Get(
     *      path="/users",
     *      operationId="all",
     *      tags={"Пользователи"},
     *      summary="Список всех пользователей",
     *      description="Возвращает список всех пользователей",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       @OA\Response(response=404, description="Resource Not Found"),
     *     )
     *
     * Returns list of users tree
     */

    public function all(User $user)
    {
        $users = Cache::remember('get_all_users', 10070, function() {
            return $this->user->get();
        });
        
        
        return response()->json([
            'data'      =>  UserResource::collection($users),
            'message'   =>  'Список всех пользователей.'
        ]);

    }

    /**
     * @OA\Get(
     *      path="/user/{id}",
     *      operationId="getUserById",
     *      tags={"Пользователь"},
     *      summary="Информация о пользователя",
     *      description="Возвращает информацию о пользователя",
     *      @OA\Parameter(
     *          name="id",
     *          description="ID пользователя",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       @OA\Response(response=404, description="Resource Not Found"),
     *     )
     *
     * Returns user data or not found
     */

    public function getUser($id)
    {
        $user = Cache::remember('get_user_' . $id, 10070, function() use ($id) {
            return $this->user->where('id', $id)->first();
        });

        if (is_null($user)) {
            throw new \Exception('Пользователь не найден', 404);
        }

        return response()->json([
            'data'      =>  new UserResource($user),
            'message'   =>  'Пользователь ID:' . $id . ' успешно найден.'
        ]);

    }


     /**
     * @OA\Get(
     *      path="/user/count",
     *      operationId="getCountUsers",
     *      tags={"Количество пользователей"},
     *      summary="Количество пользователей",
     *      description="Возвращает количество пользователей",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *     )
     *
     * Returns count users
     */

    public function getUsersCount()
    {
        $count = Cache::remember('get_users_count', 10070, function() {
            return $this->user->count();
        });

        return response()->json([
            'data'      =>  [
                'count' => $count
            ],
            'message'   =>  'Количество пользователей.'
        ]);
    }
}

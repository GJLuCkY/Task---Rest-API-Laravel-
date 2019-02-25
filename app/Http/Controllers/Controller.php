<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(
 *     description="Формат ответа на запрос <br><br> ``` {'success': true, 'message': 'Успешный ответ', 'data': null, 'code' :200}  ```",
 *     version="1.0.0",
 *     title="The task - Rest API (Laravel 5.7)",
 *     @OA\Contact(
 *         email="balymbetov.temirlan@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

/**
 *  @OA\Server(
 *      url="https://demo-777.brandstudio.kz/api",
 *      description="Task - REST API OpenApi Server"
 * )
 */



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

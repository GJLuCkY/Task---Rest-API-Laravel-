<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Town;
use App\Http\Resources\TownResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class TownApiController extends Controller
{
    protected $town;

    public function __construct(Town $town)
    {
        $this->town = $town;
    }


    /**
     * @OA\Get(
     *      path="/towns",
     *      operationId="all",
     *      tags={"Города"},
     *      summary="Список всех городов",
     *      description="Возвращает список всех городов",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       @OA\Response(response=404, description="Resource Not Found"),
     *     )
     *
     * Returns list of towns
     */

    public function all()
    {
        $towns = Cache::remember('get_all_towns', 10070, function() {
            return $this->town->get();
        });
        
        return response()->json([
            'data'      =>  TownResource::collection($towns),
            'message'   =>  'Список всех городов.'
        ]);
    }
}

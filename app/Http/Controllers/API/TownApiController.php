<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Town;
use App\Http\Resources\TownResource;
use App\Http\Controllers\Controller;

class TownApiController extends Controller
{
    protected $town;

    public function __construct(Town $town)
    {
        $this->town = $town;
    }

    public function all()
    {
        $towns = $this->town->get();
        
        return response()->json([
            'data'      =>  TownResource::collection($towns),
            'message'   =>  'Список всех городов.'
        ]);
    }
}

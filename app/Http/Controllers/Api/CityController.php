<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\City\Service\CityService;
use App\Http\Resources\Dictionaries\CityResource;

class CityController extends Controller
{
    private $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function index()
    {
        $cities = $this->cityService->getAll();

        return response()->json([
            'Cities' => CityResource::collection($cities)
        ]);
    }
}

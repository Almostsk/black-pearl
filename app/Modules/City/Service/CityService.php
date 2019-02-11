<?php

namespace App\Modules\City\Service;

use App\Modules\City\Repository\CityRepository;

class CityService
{
    /** @var CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getAll()
    {
        return $this->cityRepository->all();
    }

}
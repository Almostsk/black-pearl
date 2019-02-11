<?php

namespace App\Modules\City\Repository;

use App\Models\City;
use App\Modules\Core\BaseRepository;

class CityRepository extends BaseRepository
{
    public function __construct(City $city)
    {
        parent::__construct($city);
    }
}
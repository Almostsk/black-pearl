<?php

namespace App\Modules\Prize\Service;

use App\Modules\Prize\Repository\PrizeRepository;

class PrizeService
{
    /** @var PrizeRepository*/
    private $prizeRepository;

    public function __construct(PrizeRepository $prizeRepository)
    {
        $this->prizeRepository = $prizeRepository;
    }

    public function all()
    {
        return $this->prizeRepository->all();
    }
}
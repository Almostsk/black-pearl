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

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all()
    {
        return $this->prizeRepository->all();
    }
}
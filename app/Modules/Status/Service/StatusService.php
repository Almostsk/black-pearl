<?php

namespace App\Modules\Status\Service;

use App\Modules\Status\Repository\StatusRepository;

class StatusService
{
    private $statusRepository;

    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all()
    {
        return $this->statusRepository->all();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function pluckIdWithName()
    {
        return $this->statusRepository->pluck('name', 'id');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function pluckName()
    {
        return $this->statusRepository->pluck('name');
    }
}
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

    public function all()
    {
        return $this->statusRepository->all();
    }

    public function pluckIdWithName()
    {
        return $this->statusRepository->pluck('name', 'id');
    }

    public function pluckName()
    {
        return $this->statusRepository->pluck('name');
    }
}
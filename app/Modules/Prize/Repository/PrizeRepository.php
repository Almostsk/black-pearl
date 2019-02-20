<?php

namespace App\Modules\Prize\Repository;

use App\Models\Prize;
use App\Modules\Core\BaseRepository;

class PrizeRepository extends BaseRepository
{
    public function __construct(Prize $prize)
    {
        parent::__construct($prize);
    }
}
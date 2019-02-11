<?php

namespace App\Modules\Status\Repository;

use App\Models\Status;
use App\Modules\Core\BaseRepository;

class StatusRepository extends BaseRepository
{
    public function __construct(Status $status)
    {
        parent::__construct($status);
    }

    /**
     *  Plucks values with keys
     *  It is possible to pass 2 parameters
     * @param string $value
     * @param string|null $key
     * @return \Illuminate\Support\Collection
     */
    public function pluck(string $value, string $key = null )
    {
        return $this->all()->pluck($value, $key);
    }
}
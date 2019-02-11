<?php

namespace App\Modules\Feedback\Repository;

use App\Models\Feedback;
use App\Modules\Core\BaseRepository;

class FeedbackRepository extends BaseRepository
{
    public function __construct(Feedback $model)
    {
        parent::__construct($model);
    }

    public function getAllForIndexPage()
    {
        return $this->model->select('id', 'name', 'email', 'mobile_phone')->get();
    }
}
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

    /**
     * @return mixed
     */
    public function getAllForIndexPage()
    {
        return $this->model->select('id', 'active', 'name', 'email', 'mobile_phone')->get();
    }

    /**
     * @return mixed
     */
    public  function getActiveFeedbacks()
    {
        return $this->model
            ->select('id', 'active', 'name', 'email', 'mobile_phone')
            ->where('active', true)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getInactiveFeedbacks()
    {
        return $this->model
            ->select('id', 'active', 'name', 'email', 'mobile_phone')
            ->where('active', false)
            ->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deactivate(int $id)
    {
        return $this->model->find($id)->update([
            'active' => false
        ]);
    }
}
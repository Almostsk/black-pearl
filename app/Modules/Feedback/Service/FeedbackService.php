<?php

namespace App\Modules\Feedback\Service;

use App\Modules\Feedback\Repository\FeedbackRepository;

class FeedbackService
{
    private $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->feedbackRepository->getAllForIndexPage();
    }

    /**
     * @param array $params
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function save(array $params)
    {
        return $this->feedbackRepository->save($params);
    }

    /**
     * @return mixed
     */
    public function getActiveFeedbacks()
    {
        return $this->feedbackRepository->getActiveFeedbacks();
    }

    /**
     * @return mixed
     */
    public function getInactiveFeedbacks()
    {
        return $this->feedbackRepository->getInactiveFeedbacks();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->feedbackRepository->find($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deactivate(int $id)
    {
        return $this->feedbackRepository->deactivate($id);
    }
}
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

    public function getActiveFeedbacks()
    {
        return $this->feedbackRepository->getActiveFeedbacks();
    }

    public function getInactiveFeedbacks()
    {
        return $this->feedbackRepository->getInactiveFeedbacks();
    }

    public function find($id)
    {
        return $this->feedbackRepository->find($id);
    }

    public function deactivate(int $id)
    {
        return $this->feedbackRepository->deactivate($id);
    }
}
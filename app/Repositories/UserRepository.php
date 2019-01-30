<?php

namespace App\Repositories;

use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getDataForTheGallery()
    {
        return $this->model
            ->where([
                ['is_profile_moderated', true],
                ['can_be_brand_face', true]
            ])
            ->select('name', 'surname', 'history', 'avatar')
            ->get();
    }

    /**
     * @throws NotFoundHttpException
     * @param string $phone
     * @return int
     */
    public function findUserIdByPhone(string $phone): int
    {
        return $this->model->where('mobile_phone', '+' . $phone)->firstOrFail()->id;
    }

    /**
     * @param int $userId
     * @return string
     */
    public function getCodeSentOnMobile(int $userId): string
    {
        return $this->find($userId)->code->message_body;
    }

}
<?php

namespace App\Modules\User\Repository;

use App\Models\User;
use App\Modules\Core\BaseRepository;
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
        return $this->model->where('mobile_phone', $phone)->firstOrFail()->id;
    }

    /**
     * Returns a collection of data (or an empty collection)
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all()
    {
        return $this->model->with('city')->get();
    }

    /**
     * @param int $userId
     * @return string
     */
    public function getCodeSentOnMobile(int $userId): string
    {
        return $this->find($userId)->code->message_body;
    }

    /**
     * Gets last three records from users table for 'our stars' block ( main page)
     *
     * @return mixed
     */
    public function getThreeStars()
    {
        return $this->model
            ->with('city')
            ->select('id', 'name', 'surname', 'city_id', 'avatar')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();
    }
}
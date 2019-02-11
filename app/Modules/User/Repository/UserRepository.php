<?php

namespace App\Modules\User\Repository;

use Carbon\Carbon;
use App\Models\User;
use App\Modules\Core\BaseRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getOnModerationStatus()
    {
        return User::STATUS_ON_MODERATION;
    }

    public function getBannedStatus()
    {
        return User::STATUS_BANNED;
    }

    public function getAcceptedStatus()
    {
        return User::STATUS_ACCEPTED;
    }

    public function getDataForTheGallery()
    {
        return $this->model
            ->where([
                ['status_id', $this->getAcceptedStatus()],
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
        return $this->model->with('city', 'status')->get();
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

    /**
     * Get Users that have not been moderated yet (for admin panel)
     *
     * @return mixed
     */
    public function getNotModeratedUsers()
    {
        return $this->model
            ->where('status_id', $this->getOnModerationStatus())->get();
    }

    public function getUsersForExport()
    {
        return $this->model
            ->select('id', 'name', 'surname', 'mobile_phone', 'created_at', 'status')
            ->get();
    }

    public function update(array $params, int $id)
    {
        $this->model->find($id)->update($params);
    }

    public function getAllWith(array $params)
    {
        return $this->model->with($params)->get();
    }

    public function getUsersStars()
    {
        return $this->model->where([
            ['status_id', $this->getAcceptedStatus()],
            ['can_be_brand_face', true]
        ])->with('status')->get();
    }

    public function getUsersWithCodes()
    {
        return $this->model
            ->whereHas('codes', function ($query){
                $query->where('expires_at', '>', Carbon::now());
            })
            ->distinct()
            ->get();
    }

    /**
     * Checks whether this user exists and has admin role
     *
     * @param $mobile_phone
     * @return bool | user
     */
    public function getUserIfAdmin($mobile_phone)
    {
        $user = $this->model->where('mobile_phone', '=', $mobile_phone)->first();

        if ($user == null || $user->is_admin == false) {
            return false;
        }

        return $user;
    }

    public function getAllWinners()
    {
        return $this->model->whereHas('prizes')->get();
    }

    public function getWinnerOfPrize(int $prizeId)
    {
        return $this->model->whereHas('prizes', function($query) use ($prizeId) {
            $query->where('prize_id', $prizeId);
        })->get();
    }
}
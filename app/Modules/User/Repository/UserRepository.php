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

    /**
     * @return int
     */
    public function getOnModerationStatus()
    {
        return User::STATUS_ON_MODERATION;
    }

    /**
     * @return int
     */
    public function getBannedStatus()
    {
        return User::STATUS_BANNED;
    }

    /**
     * @return int
     */
    public function getAcceptedStatus()
    {
        return User::STATUS_ACCEPTED;
    }

    /**
     * @return mixed
     */
    public function getDataForTheGallery()
    {
        return $this->model
            ->where([
                ['status_id', $this->getAcceptedStatus()],
                ['can_be_brand_face', true]
            ])
            ->select('id', 'name', 'surname', 'about_me', 'city_id', 'avatar')
            ->orderBy('id', 'desc')
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
     * Gets last three records from users table for 'our stars' block ( main page)
     *
     * @return mixed
     */
    public function getThreeStars()
    {
        return $this->model
            ->with('city')
            ->select('id', 'name', 'surname', 'city_id', 'avatar')
            ->where([
                ['status_id', $this->getAcceptedStatus()],
                ['can_be_brand_face', true]
            ])
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

    /**
     * @param array $params
     * @param int $id
     */
    public function update(array $params, int $id)
    {
        $this->model->find($id)->update($params);
    }

    /**
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllWith(array $params)
    {
        return $this->model->with($params)->get();
    }

    /**
     * @return mixed
     */
    public function getUsersStars()
    {
        return $this->model->where([
            ['status_id', $this->getAcceptedStatus()],
            ['can_be_brand_face', true]
        ])->with('status')->get();
    }

    /**
     * @return mixed
     */
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

    /**
     * @return mixed
     */
    public function getAllWinners()
    {
        return $this->model->whereHas('prizes')->get();
    }

    /**
     * @param int $prizeId
     * @return mixed
     */
    public function getWinnersByPrizeId(int $prizeId)
    {
        return $this->model
            ->whereHas('prizes', function ($query) use ($prizeId) {
                $query->where('prize_id', $prizeId);
            })
            ->get();
    }

    /**
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getDataForPersonalCabinet(int $userId)
    {
        return $this->model->with('codes', 'city')->find($userId);
    }

    /**
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getWithIds(array $ids)
    {
        return $this->model
            ->whereIn('id', $ids)
            ->select('id', 'name', 'surname', 'city_id', 'mobile_phone', 'status_id')
            ->get();
    }

    public function searchGallery(string $q)
    {
        return $this->model
            ->join('cities', 'users.city_id', '=', 'cities.id')
            ->select('users.id', 'users.name', 'users.surname', 'users.avatar', 'users.avatar', 'users.city_id')
            ->where(function ($query) use ($q) {
                $query->orWhere('users.name', 'LIKE', '%' . $q . '%');
                $query->orWhere('surname', 'LIKE', '%' . $q . '%');
                $query->orWhere('cities.name', 'LIKE', '%' . $q . '%');
            })
            ->where(function ($query) use ($q) {
                $query->where('avatar', '!=', '');
            })
            ->get();
    }
}
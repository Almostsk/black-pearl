<?php

namespace App\Modules\User\Service;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Modules\User\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all()
    {
        return $this->userRepository->all();
    }

    /**
     * Get Users that have not been moderated yet (for admin panel)
     *
     * @return mixed
     */
    public function getNotModeratedUsers()
    {
        return $this->userRepository->getNotModeratedUsers();
    }

    /**
     * Gets the needed data for the gallery page
     *
     * @return mixed
     */
    public function getDataForTheGallery()
    {
        return $this->userRepository->getDataForTheGallery();
    }

    /**
     * Returns ID of the user with specific phone
     *
     * @throws NotFoundHttpException
     * @param string $phone
     * @return int
     */
    public function findUserIdByPhone(string $phone): int
    {
        return $this->userRepository->findUserIdByPhone($phone);
    }

    /**
     * Saving the user
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function save(Request $request)
    {
        $params = array_merge($request->all(), [
            'password' => bcrypt(config('app.user_password'))
        ]);

        if ($request->hasFile('avatar') && $request->has('about_me')) {
            // is a participant in brand face

            $filename = $this->storeAvatar($request);

            return $this->userRepository->save(array_merge($params, [
                'avatar' => $filename,
                'can_be_brand_face' => true
            ]));
        } elseif ($request->hasFile('avatar')) {
            // participating only in black pearl but has avatar

            $filename = $this->storeAvatar($request);

            return $this->userRepository->save(array_merge($params, [
                'status_id' => $this->userRepository->getAcceptedStatus(),
                'avatar' => $filename
            ]));
        }

        // participating only in black pearl
        return $this->userRepository->save(array_merge($params, [
            'status_id' => $this->userRepository->getAcceptedStatus()
        ]));

    }

    /**
     * Gets last three records from users table for 'our stars' block ( main page)
     *
     * @return mixed
     */
    public function getStarsForMainPage()
    {
        return $this->userRepository->getThreeStars();
    }

    /**
     * Find user with ID
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * Updating the user
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {
        $params = $request->all();

        if ($request->hasFile('avatar') && $request->has('about_me')) {
            // is a participant in brand face

            $filename = $this->storeAvatar($request);

            return $this->userRepository->update(array_merge($params, [
                'avatar' => $filename,
                'can_be_brand_face' => true
            ]), $id);
        } elseif ($request->hasFile('avatar')) {
            // participating only in black pearl but has avatar

            $filename = $this->storeAvatar($request);

            return $this->userRepository->update(array_merge($params, [
                'avatar' => $filename
            ]), $id);
        }

        return $this->userRepository->update($params, $id);
    }

    /**
     * @return mixed
     */
    public function getWinners()
    {
        return $this->userRepository->getAllWinners();
    }

    /**
     * @param int $prizeId
     * @return mixed
     */
    public function getWinnersByPrizeId(int $prizeId)
    {
        return $this->userRepository->getWinnersByPrizeId($prizeId);
    }

    /**
     * @return mixed
     */
    public function getUsersStars()
    {
        return $this->userRepository->getUsersStars();
    }

    /**
     * @return mixed
     */
    public function getUsersWithCodes()
    {
        return $this->userRepository->getUsersWithCodes();
    }

    /**
     * Saving avatar logic
     *
     * @param Request $request
     * @return string
     */
    private function storeAvatar(Request $request): string
    {
        $filename = hash('md5', time() . uniqid()) . '.png';

        Storage::put('/public/' . $filename, file_get_contents($request->file('avatar')));

        return $filename;
    }

    /**
     * @return mixed
     */
    public function getGalleryUsers()
    {
        return $this->userRepository->getDataForTheGallery();
    }

    /**
     * @param array $params
     * @return bool
     */
    public function authorizeAdmin(array $params)
    {
        if (Auth::attempt([
                'mobile_phone' => $params['mobile_phone'],
                'password' => $params['password'],
            ])) {
            $user = $this->userRepository->getUserIfAdmin($params['mobile_phone']);

            if ($user) {
                Auth::loginUsingId($user->id);
                return true;
            }
        }

        return false;
    }

    /**
     * @throws TokenExpiredException
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getDataForPersonalCabinet()
    {
        $user = Auth::user();

        if ($user) {
            return $this->userRepository->getDataForPersonalCabinet($user->id);
        }

        throw new TokenExpiredException();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function getRecentlyViewed()
    {
        $ids = Session::get('viewed');

        if (count($ids) > 0) {
            return $this->userRepository->getWithIds($ids);
        }
        return collect();
    }

    public function searchGallery(array $params)
    {
        return $this->userRepository->searchGallery($params['q']);
    }

    public function userExistsWithNumber(string $mobilePhone)
    {
        return $this->userRepository->userExistsWithNumber($mobilePhone);
    }
}
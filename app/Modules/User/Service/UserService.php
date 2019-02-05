<?php

namespace App\Modules\User\Service;

use Illuminate\Http\Request;
use App\Modules\User\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
     * Gets the code that has been sent on mobile to authorize user
     *
     * @param int $userId
     * @return string
     */
    public function getCodeSentOnMobile(int $userId): string
    {
        return $this->userRepository->getCodeSentOnMobile($userId);
    }

    /**
     * Saving the user
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function save(Request $request)
    {
        if ($request->has('avatar') && $request->has('about_me')) {
            // is a participant in brand face
            $request->merge([
                'can_be_brand_face' => false,
                'password' => config('app.user_password')
            ]);
        } else {
            // participating only in black pearl
            $request->merge([
                'is_profile_moderated' => true,
                'password' => config('app.user_password')
            ]);
        }

        return $this->userRepository->save($request->all());
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
}
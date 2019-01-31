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

    /**
     * Generates JSON with response with token
     *
     * @param string $token
     * @param array $userData
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendUserDataWithToken(string $token, array $userData = [])
    {
        return response()->json([
            'token' => 'Bearer ' . $token,
            'user' => $userData
        ]);
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
}
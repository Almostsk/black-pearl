<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Slack\Service\SlackService;
use App\Http\Services\StartMobile\Service\SmsService;
use Session;
use App\Exports\UsersExport;
use App\Exports\UsersStarsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersWithCodeExport;
use App\Http\Controllers\Controller;
use App\Modules\User\Service\UserService;
use App\Modules\Status\Service\StatusService;
use App\Http\Requests\Admin\UpdateUserRequest;

class UserController extends Controller
{
    /** @var UserService */
    private $userService;

    /** @var StatusService */
    private $statusService;

    /** @var SmsService */
    protected $smsService;

    /** @var SlackService */
    protected $slackService;

    public function __construct(UserService $userService,
                                StatusService $statusService,
                                SmsService $smsService,
                                SlackService $slackService)
    {
        $this->userService = $userService;
        $this->statusService = $statusService;
        $this->smsService = $smsService;
        $this->slackService = $slackService;
    }

    /**
     * Get list of all users
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => $this->userService->all(),
        ]);
    }

    public function edit($id)
    {
        Session::push('viewed', $id);

        return view('admin.users.edit', [
            'user' => $this->userService->find($id),
            'statuses' => $this->statusService->pluckIdWithName()
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $this->userService->update($request, $id);
        Session::flash('success', 'Запис було успішно оновлено');
        return redirect()->route('users.index');
    }

    /**
     * Get all winners
     */
    public function winners()
    {
        return view('admin.users.index', [
            'users' => $this->userService->getWinners()
        ]);
    }

    /**
     * Winners of the prize
     *
     * @param $prizeId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function winnersOfPrize($prizeId)
    {
        return view('admin.users.winners', [
            'users' => $this->userService->getWinnersByPrizeId($prizeId)
        ]);
    }

    /**
     * Not moderated users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function moderate()
    {
        return view('admin.users.index', [
            'users' => $this->userService->getNotModeratedUsers()
        ]);
    }

    /**
     * Users participating in main prize flow
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function usersStars()
    {
        return view('admin.users.stars', [
            'users' => $this->userService->getUsersStars()
        ]);
    }

    /**
     * Users who put their codes and they are valid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function usersCodes()
    {
        return view('admin.users.users_codes', [
            'users' => $this->userService->getUsersWithCodes()
        ]);
    }


    /**
     * Exports all the users to excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportAll()
    {
        return Excel::download(new UsersExport(), 'all_users_' . date("y_m_d_h_i_s") . '.xlsx');
    }

    /**
     * Exports all the users that can participate in main draw
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportStars()
    {
        return Excel::download(new UsersStarsExport(), 'stars_' . date("y_m_d_h_i_s") . '.xlsx');
    }

    /**
     * Exports all the users with valid input codes
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportUsersWithCode()
    {
        return Excel::download(new UsersWithCodeExport(), 'codes_' . date("y_m_d_h_i_s") . '.xlsx');
    }

    /**
     * Get recently viewed users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recent()
    {
        return view('admin.users.recent', [
            'users' => $this->userService->getRecentlyViewed()
        ]);
    }

    public function winnerIdentify()
    {
        $user = $this->userService->getRandomCodesWinner();

        $this->userService->saveCodeWinner($user->id);
        $this->smsService->sendMessage(config('response_message.congratulations_black_pearl'), $user->mobile_phone);
        $this->slackService->sendNotificationAboutWinner($user->id, $user->name, $user->surname);
    }
}

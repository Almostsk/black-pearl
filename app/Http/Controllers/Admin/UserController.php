<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Exports\UsersExport;
use App\Exports\UsersStarsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersWithCodeExport;
use App\Http\Controllers\Controller;
use App\Modules\User\Service\UserService;
use App\Modules\Status\Service\StatusService;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\AuthorizeAdminRequest;

class UserController extends Controller
{
    /** @var UserService */
    private $userService;

    /** @var StatusService */
    private $statusService;

    public function __construct(UserService $userService, StatusService $statusService)
    {
        $this->userService = $userService;
        $this->statusService = $statusService;
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
        /*dd($this->userService->getWinners());
        return view('admin.users.index', [
            'users' => $this->userService->getWinners()
        ]);*/
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function moderate()
    {
        return view('admin.users.index', [
            'users' => $this->userService->getNotModeratedUsers()
        ]);
    }

    public function usersStars()
    {
        return view('admin.users.stars', [
            'users' => $this->userService->getUsersStars()
        ]);
    }

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

    public function authorizeAdmin(AuthorizeAdminRequest $request)
    {
        $isAdmin = $this->userService->authorizeAdmin($request->all());

        if ($isAdmin) {
            return redirect()->route('users.index');
        }

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Modules\User\Service\UserService;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get list of all users
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => $this->userService->all()
        ]);
    }

    public function edit($id)
    {
        return view('admin.users.edit', [
            'user' => $this->userService->find($id)
        ]);
    }

    /**
     * Get all winners
     */
    public function winners()
    {

    }

    public function moderate()
    {
        return view('admin.users.index', [
            'users' => $this->userService->getNotModeratedUsers()
        ]);
    }

    public function exportAll()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }
}

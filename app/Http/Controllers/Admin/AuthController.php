<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Http\Controllers\Controller;
use App\Modules\User\Service\UserService;
use App\Http\Requests\Admin\AuthorizeAdminRequest;

class AuthController extends Controller
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function authorizeAdmin(AuthorizeAdminRequest $request)
    {
        $isAdmin = $this->userService->authorizeAdmin($request->all());

        if ($isAdmin) {
            return redirect()->route('users.index');
        }

        return redirect('/');
    }

    public function logIn()
    {
        if (Auth::user() == null) {
            return view('admin.authorize');
        }

        return redirect()->route('admin_home');
    }

    public function logout()
    {
        // clearing the session with viewed users
        Session::flush();

        auth()->logout();

        return redirect('/');
    }
}

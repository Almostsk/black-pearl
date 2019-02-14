<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthorizeAdminRequest;
use App\Modules\User\Service\UserService;

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

    public function logout()
    {
        // clearing the session with viewed users
        Session::flush();

        auth()->logout();

        return redirect('/');
    }
}

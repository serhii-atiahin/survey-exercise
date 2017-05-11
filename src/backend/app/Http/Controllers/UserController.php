<?php

namespace App\Http\Controllers;

use App\Constants\Cookie;
use App\Constants\Route;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    const INPUT_NAME     = 'name';

    const INPUT_PASSWORD = 'password';

    /**
     * @return \Illuminate\View\View
     */
    public function renderForm()
    {
        return view('login_form');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            User::NAME     => 'required',
            User::PASSWORD => 'required',
        ]);

        $user = User::where(User::NAME, $request->input(static::INPUT_NAME))->first();

        if ($user === null) {
            return redirect()->route(Route::LOGIN_FORM);
        }

        if (!Hash::check($request->input(static::INPUT_PASSWORD), $user->password)) {
            return redirect()->route(Route::LOGIN_FORM);
        }

        setcookie(Cookie::USER, serialize($user));

        return redirect()->route(Route::SURVEY_FORM);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        setcookie(Cookie::USER, null, time() - 3600);

        return redirect()->route(Route::LOGIN_FORM);
    }
}

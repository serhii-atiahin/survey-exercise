<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('login', ['as' => 'login', function () {
    return view('login');
}]);

$app->post('login', function (Request $request) {
    $this->validate($request, [
        User::NAME     => 'required',
        User::PASSWORD => 'required',
    ]);

    $user = User::where(User::NAME, $request->input('name'))->first();

    if ($user === null) {
        return redirect()->route('login');
    }

    if (!Hash::check($request->input('password'), $user->password)) {
        return redirect()->route('login');
    }

    setcookie('user', serialize($user));

    return redirect()->route('form');
});

$app->group(['middleware' => 'auth'], function () use ($app) {


    $app->get('form', ['as' => 'form', function () {
        $questions = app('db')->select("SELECT * FROM questions");

        return view('form', ['questions' => $questions]);
    }]);
});

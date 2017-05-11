<?php

use App\Constants\Route;

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

$app->get('login', ['as' => Route::LOGIN_FORM, 'uses' => 'UserController@renderForm']);
$app->post('login', 'UserController@login');

$app->get('logout', 'UserController@logout');

$app->group(['middleware' => 'auth'], function () use ($app) {
    $app->get('form', ['as' => Route::SURVEY_FORM, 'uses' => 'SurveyController@renderForm']);
    $app->post('form', 'SurveyController@save');
});

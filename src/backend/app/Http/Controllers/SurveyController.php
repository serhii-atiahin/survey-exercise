<?php

namespace App\Http\Controllers;

use App\Constants\Route;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function renderForm(Request $request)
    {
        $questions = Question::with(['users' => function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        }])->get();

        return view('survey_form', [
            'questions' => $questions,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request) {
        $user = User::find($request->user()->id);

        $answers = [];
        foreach($request->all() as $questionId => $answer) {
            $answers[$questionId] = ['answer' => (int)$answer];
        }

        $user->questions()->sync($answers);

        return redirect()->route(Route::SURVEY_FORM);
    }
}

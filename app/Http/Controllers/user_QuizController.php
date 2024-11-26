<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuizDtl;
use App\Models\StudInfo;
use Illuminate\Http\Request;

class user_QuizController extends Controller
{

    public function quiz_dtl($slug)
    {
        $quiz = QuizDtl::where('url_slug', $slug)->firstOrFail();

        return view('users.quiz.details', compact('quiz'));
    }

    // Handle form submission and display quiz
    public function submitUserDetails(Request $request, $slug)
    {
        // $quiz = QuizDtl::where('slug', $slug)->firstOrFail();

        // Validate user inputs
        $validated = $request->validate([
            // 'name' => 'required|string|max:255',
            // 'gender' => 'required|string|in:Male,Female,Other',
            // 'email' => 'required|email',
            // 'mobile' => 'required|digits:10',
        ]);

        return $request;
        // Save the user details in the database
        // $studInfo = StudInfo::create([
        //     'name' => $request->name,
        //     'gender' => $request->gender,
        //     'email' => $request->email,
        //     'mobile' => $request->mobile,
        // ]);

        // Optionally save user details in the database
        // $request->session()->put('user_details', $request->only('name', 'gender', 'email', 'mobile'));

        // Get quiz questions
        // $questions = Question::where('quiz_id', $quiz->id)->get();

        // return view('users.quiz.start', compact('quiz', 'validated', 'questions'));
    }

    // Show the user details form
    public function startQuiz($slug)
    {
        $quiz = QuizDtl::where('url_slug', $slug)->firstOrFail();

        return view('users.quiz.start', compact('quiz'));
    }
}

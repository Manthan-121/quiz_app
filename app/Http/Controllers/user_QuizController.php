<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class user_QuizController extends Controller
{
    // Show the user details form
    public function startQuiz($slug)
    {
        $quiz = QuizDtl::where('slug', $slug)->firstOrFail();

        return view('quiz.start', compact('quiz'));
    }

    // Handle form submission and display quiz
    public function submitUserDetails(Request $request, $slug)
    {
        $quiz = QuizDtl::where('slug', $slug)->firstOrFail();

        // Validate user inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
        ]);

        // Optionally save user details in the database

        // Get quiz questions
        $questions = Question::where('quiz_id', $quiz->id)->get();

        return view('quiz.questions', compact('quiz', 'validated', 'questions'));
    }
}

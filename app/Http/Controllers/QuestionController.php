<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuizDtl;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all quizzes and count their questions
        $quizzes = QuizDtl::withCount('questions')->get();

        return view('admin.questions.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Initialize $questions as an empty array
        $questions = [];

        // Get available quizzes
        $quizzes = QuizDtl::all();

        return view('admin.questions.create', compact('questions', 'quizzes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quiz_id' => 'required|exists:quiz_dtl,id', // Ensure a valid quiz ID is provided
            'questions.*.question' => 'required|string|max:255',
            'questions.*.correct_option' => 'required|string|max:255',
            'questions.*.options' => 'required|string', // Ensure options are provided as a comma-separated string
        ]);

        // Retrieve quiz ID
        $quizId = $validated['quiz_id'];

        // Iterate over the questions and save them
        foreach ($validated['questions'] as $questionData) {
            $options = explode(',', $questionData['options']); // Convert options to an array

            Question::create([
                'quiz_id' => $quizId,
                'question' => $questionData['question'],
                'correct_option' => $questionData['correct_option'],
                'options' => json_encode($options), // Store as JSON
            ]);
        }

        return redirect()->route('admin.questions.index')->with('success', 'Questions added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

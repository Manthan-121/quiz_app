<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizDtl;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class QuizDtlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = QuizDtl::all();
        return view('admin.quiz.index', compact('quizzes'));
        // return view('admin.quiz.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer',
        ]);

        $quiz = QuizDtl::create($validated);

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($url_slug)
    {
        // $quiz = QuizDtl::where('url_slug', $url_slug)->firstOrFail();
        // return view('admin.quiz.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $quiz = QuizDtl::findOrFail($id);
        return view('admin.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer',
        ]);

        $quiz = QuizDtl::findOrFail($id);
        $quiz->update($request->all());

        return redirect()->route('admin.quiz.index')->with('edt-success', 'Quiz updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(Request $request)
    {
        Log::info('Request received to toggle status', ['id' => $request->id, 'status' => $request->status]);

        $quiz = QuizDtl::find($request->id);
        if (!$quiz) {
            Log::error('Quiz not found', ['id' => $request->id]);
            return response()->json(['success' => false, 'error' => 'Quiz not found'], 404);
        }

        $quiz->active = $request->status;
        $quiz->save();

        Log::info('Quiz status updated successfully', ['id' => $quiz->id, 'new_status' => $quiz->active]);

        return response()->json(['success' => true]);
    }
}

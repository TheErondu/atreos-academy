<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $courseId = $request->query('courseId');
        $testId = $request->query('testId');
        return view('dashboard.admin.questions.create',compact('courseId','testId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $test_id)
    {
        $validatedData = $request->validate([
            'question' => 'required',
            'course_id' => 'required',
            'question_type' => 'required',
            'answer' => 'required',
        ]);

        if ($request->input('question_options')) {
            $validatedData['question_options'] = $request->input('question_options');
        }

        // dd($validatedData);
        Question::create($validatedData);

        // Redirect or respond as needed
        return redirect()->route('tests.edit', $test_id)->with('success', 'Question added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $questions, )
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Question $question)
    {
        $testId = $request->query('testId');
        return view('dashboard.admin.questions.edit',compact('question','testId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
{
    $validatedData = $request->validate([
        'question' => 'required',
        'course_id' => 'required',
        'question_type' => 'required',
        'answer' => 'required',
    ]);

    if ($request->input('question_options')) {
        $validatedData['question_options'] = $request->input('question_options');
    }
    $question->update($validatedData);

    return redirect()->route('tests.edit', $question->course->test->id)->with('success', 'Question updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $questions)
    {
        //
    }
}

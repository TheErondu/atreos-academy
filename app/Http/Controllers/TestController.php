<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = Test::all();
        return view('dashboard.admin.tests.index', compact('tests', ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('dashboard.admin.tests.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'instructions' => 'required',
            'duration_in_minutes' => 'required',
            'course_id' => 'required|exists:courses,id', // Make sure the course_id exists in the courses table
        ]);
        $course = Course::find($validatedData['course_id']);
        if ($request->input('title') == null) {
            $validatedData['title'] = $course->title;
        }

        // Assuming Test model has a belongsTo relationship with Course
        // dd($validatedData);
        $test = Test::create($validatedData);

        // Redirect or respond as needed
        return redirect()->route('tests.edit', $test->id)->with('success', 'Test created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        // Get a random set of 6 questions in random order, paginate by 1
        $questions = Question::where('course_id',$test->course->id)->take(6)->inRandomOrder()->get()->paginate(1);
       // dd($questions);
        // Pass the data to the view
        return view('dashboard.student.tests.show', compact('test', 'questions'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        $courses = Course::all();
        $questions = Question::where('course_id', '=', $test->course->id)->paginate('9');
        return view('dashboard.admin.tests.edit', compact('courses', 'test', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $validatedData = $request->validate([
            'instructions' => 'required',
            'duration_in_minutes' => 'required',
            'course_id' => 'required|exists:courses,id', // Make sure the course_id exists in the courses table
        ]);
        $course = Course::find($validatedData['course_id']);
        if ($request->input('title') == null) {
            $validatedData['title'] = $course->title;
        }

        // Assuming Test model has a belongsTo relationship with Course
        // dd($validatedData);
        $test->update($validatedData);
        // Redirect or respond as needed
        return redirect()->route('tests.edit', $test->id)->with('success', 'Test updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        //
    }
}

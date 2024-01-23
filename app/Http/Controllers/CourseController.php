<?php

namespace App\Http\Controllers;

use App\DTOs\ProgressDTO;
use App\Globals\EnrollmentGlobals;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::paginate(4);
        if (Auth::user()->hasRole('Admin')) {
            $view = 'dashboard.admin.courses.index';
        }
        if (Auth::user()->hasRole('Staff')) {
            $view = 'dashboard.student.courses.index';
        }
        return view($view, compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'poster' => 'required|image|mimes:jpeg,jpg,png|max:2048', // Max file size: 2MB
        ]);

        // Handle file upload
        $prefix = substr(Str::slug($request->input('title'), '_'), 0, 20);
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $fileName = $prefix . '-' . 'poster' . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/course_posters/', $fileName);
            $validatedData['poster'] = $fileName;
        }
        // dd($validatedData);


        // Create a new course with the validated data
        $course = Course::create($validatedData);

        // Redirect or respond as needed
        return redirect()->route('courses.edit', $course->id)->with('success', 'Course created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Course $course)
    {
        if (Auth::user()->hasRole('Admin')) {
            return view('dashboard.admin.courses.edit', compact('course'));

        }
        if (Auth::user()->hasRole('Staff')) {
            $data['user_id'] = Auth::user()->id;
            $data['course_id'] = $course->id;
            $data['status'] = "started";
            $progressDTOList = [];
            foreach ($course->lessons as $lesson) {
                $progressDTO = new ProgressDTO(
                    $lesson->id,
                    null,
                    null
                );
                $progressDTOList[] = $progressDTO;
            }
            $data['progress'] = $progressDTOList;
            // Check for existing enrollment based on user_id and course_id
            $enrollment = Enrollment::firstOrCreate(
                ['user_id' => $data['user_id'], 'course_id' => $data['course_id']],
                $data
            );

            return view('dashboard.student.courses.enroll', compact('enrollment','course'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'poster' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048', // Max file size: 2MB
        ]);

        // Handle file upload if a new poster is provided
        if ($request->hasFile('poster')) {
            $prefix = substr(Str::slug($request->input('title'), '_'), 0, 20);

            $file = $request->file('poster');
            $fileName = $prefix . '-' . 'poster' . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/course_posters/', $fileName);

            // Remove old poster file (optional)
            if ($course->poster) {
                Storage::delete('public/course_posters/' . $course->poster);
            }

            // Update the poster attribute
            $validatedData['poster'] = $fileName;
        }

        // Update the course with the validated data
        $course->update($validatedData);

        // Redirect or respond as needed
        return redirect()->route('courses.edit', $course->id)->with('success', 'Course updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}

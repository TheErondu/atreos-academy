<?php

namespace App\Http\Controllers;

use App\DTOs\ProgressDTO;
use App\Globals\EnrollmentGlobals;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Role;
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
            $courses = Course::orderBy('id', 'desc')->paginate(4);
        }
        else {
            $view = 'dashboard.student.courses.index';
            $userRoleId = Role::where('name',Auth::user()->role)->get()->pluck('id');
           // dd($userRoleId);
            $courses = Course::whereIn('assigned_roles', $userRoleId)->get();
        }
        return view($view, compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.admin.courses.create',compact('roles'));
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
            'assigned_roles' => 'required'
        ]);

        if (!empty($request->input('assigned_roles'))) {
            $validatedData['assigned_roles'] = implode(",", $request->input('assigned_roles'));
        }

        // Handle file upload
        if ($request->hasFile('poster')) {
            $prefix = substr(Str::slug($request->input('title'), '_'), 0, 20);

            $file = $request->file('poster');
            $fileName = $prefix . '-' . 'poster' . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/course_posters/', $fileName);
            // Update the poster attribute
            $validatedData['poster'] = $fileName;
        }
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
            $roles = Role::all();
            return view('dashboard.admin.courses.edit', compact('course','roles'));

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
             // Remove old poster file (optional)
             if ($course->poster) {
                Storage::delete('public/course_posters/' . $course->poster);
            }
            $file->storeAs('public/course_posters/', $fileName);



            // Update the poster attribute
            $validatedData['poster'] = $fileName;
        }
        if (!empty($request->input('assigned_roles'))) {
            $validatedData['assigned_roles'] = implode(",", $request->input('assigned_roles'));
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

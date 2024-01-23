<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Question;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::all();
        return view('dashboard.admin.lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $courses = Course::all();
        $course = Course::find($request->query('course'));
        return view('dashboard.admin.lessons.create', compact('courses','course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'course_id' => 'required',
            'content' => 'required'
        ]);
        $prefix = substr(Str::slug($request->input('title'), '_'), 0, 20);
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = $prefix . '-' . 'document' . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/lesson_documents/', $fileName);
            $validatedData['document'] = $fileName;
        }
        if($request->input('video_url')){
            $validatedData['video_url'] = $request->input('video_url');
        }
        //dd($validatedData);
        // Create a new lesson with the validated data
        $lesson = Lesson::create($validatedData);

        // Redirect or respond as needed
        return redirect()->route('lessons.edit', $lesson->id)->with('success', 'Lesson created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Lesson $lesson)
    {
        $enrollment = Enrollment::find($request->query('enrollment'));
        return view('dashboard.student.lessons.show', compact('lesson', 'enrollment'));
    }

    public function completeLesson(Request $request, Enrollment $enrollment)
    {
        $enrollmentDetails =$enrollment->progress->toArray();
        $lessonId = $request->query('lessonId');
        $lessonIndex = array_search($lessonId, array_column($enrollmentDetails, 'lessonId'));
        if ($lessonIndex !== false) {
            // Update the completedDate for the found lesson
            $enrollmentDetails[$lessonIndex]['completedDate'] = Carbon::now()->toDateTimeString();
            // Update the progress in the enrollment model
            $enrollment->update(['progress' => $enrollmentDetails]);

            // Optionally, you can also update the overall status if needed
            // $enrollment->update(['status' => 'completed']);
            $lesson = Lesson::find($lessonId);

            // Pass enrollment to the view, which includes the decoded progress
           return redirect()->route('courses.edit', $enrollment->course->id)->with('success','lesson completed!');
        } else {
            return redirect()->back()->with('error', 'Lesson not found');
        }
    }


    public function startLesson(Request $request, Enrollment $enrollment)
    {
        $enrollmentDetails =$enrollment->progress->toArray();
        $lessonId = $request->query('lessonId');
        $lessonIndex = array_search($lessonId, array_column($enrollmentDetails, 'lessonId'));
        if ($lessonIndex !== false) {
            // Update the completedDate for the found lesson
            $enrollmentDetails[$lessonIndex]['startDate'] = Carbon::now()->toDateTimeString();
            // Update the progress in the enrollment model
            $enrollment->update(['progress' => $enrollmentDetails]);
            $lesson = Lesson::find($lessonId);
            // Pass enrollment to the view, which includes the decoded progress
           return redirect()->route('lessons.show',['lesson'=>$lesson,'enrollment'=>$enrollment])->with('success','lesson started!');
        } else {
            return redirect()->back()->with('error', 'Lesson not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        return view('dashboard.admin.lessons.edit', compact('lesson', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'course_id' => 'required',
            'content' => 'required'
        ]);
        //dd($validatedData);
        // Update the lesson with the validated data
        $prefix = substr(Str::slug($request->input('title'), '_'), 0, 20);
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = $prefix . '-' . 'document' . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/lesson_documents/', $fileName);
            $validatedData['document'] = $fileName;
        }
        if($request->input('video_url')){
            $validatedData['video_url'] = $request->input('video_url');
        }
        $lesson->update($validatedData);

        // Redirect or respond as needed
        return redirect()->route('lessons.edit', $lesson->id)->with('success', 'Lesson updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
    public function generateQuestions(Request $request, Lesson $lesson)
    {
        $openAIKey = env('OPEN_AI_API_KEY');
        $lessonContents = $lesson->description;

        $prompt = "generate 6 multiple choice questions from $lessonContents give your output in json list with questions and a answers as key value pairs";

        // Call the OpenAI API to generate questions
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $openAIKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
                    'prompt' => $prompt,
                    "model" => "gpt-3.5-turbo",
                    "response_format" => '{ "type": "json_object" }',
                    'temperature' => 0.7,
                    'n' => 1, // Generate only one response
                ]);

        $generatedQuestions = json_decode($response->body(), true);

        dd($generatedQuestions);

        // Save the generated questions to the database
        $question = new Question();
        $question->lesson_contents = $lessonContents;
        $question->questions_and_answers = json_encode(['questions' => $generatedQuestions['choices']]);
        $question->save();

        return response()->json(['questions' => $generatedQuestions['choices']]);
    }
}

<?php

namespace App\Http\Controllers;

use App\DTOs\NotificationDetails;
use App\Models\Enrollment;
use App\Models\Question;
use App\Models\TestAnswer;
use App\Notifications\EnrollmentCompleted;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TestAnswerController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Question $question)
    {
        $answer = $request->input('answer');
        $nextPageUrl = $request->query('nextPageUrl');
        $user_id = auth()->user()->id;
        $test_id = $question->course->test->id;
        $question_id = $question->id;


        // Save the user's answer
        TestAnswer::firstOrCreate(
            ['user_id' => $user_id, 'test_id' => $test_id, 'question_id' => $question_id],
            ['answer' => $answer]
        );

        if ($request->query('submit') == "true") {
            // Retrieve user's answers for the test
            $answers = TestAnswer::where('user_id', $user_id)
                ->where('test_id', $test_id)
                ->get();

            // Retrieve test questions based on user's answers
            $testQuestions = Question::whereIn('id', $answers->pluck('question_id'))->get();

            // Calculate the overall score
            $score = 0;
            foreach ($testQuestions as $testQuestion) {
                $questionId = $testQuestion->id;
                $userAnswer = $answers->where('question_id', $questionId)->first();

                if ($userAnswer && $testQuestion->answer == $userAnswer->answer) {
                    $score += $question->points;
                }
            }

            // Do something with the $score variable (e.g., save it to the database)
            // ...

            $enrollment = Enrollment::where('user_id',$user_id)
            ->where('course_id',$question->course->id)->first();
            $course = $question->course;

            $enrollment->update([
                'status' => 'completed',
                'completed_at' => Carbon::now(),
                'test_score' => $score
            ]);

            $notificationDetails = new NotificationDetails(
                'Congratulations!',
                'You have successfully completed the test for the course:'.$enrollment->course->title,
                'View Results',
                '/test-results',
                'Your Score: ' . $enrollment->test_score . '/' . $question->course->test->test_score
            );

            auth()->user()->notify(new EnrollmentCompleted($notificationDetails));

            return redirect()->route('courses.edit',$course)->with('success','Test completed! Goodluck!');
        } else {
            // Do something if 'submit' is not true (e.g., redirect to the next page)
            return redirect()->to($nextPageUrl);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(TestAnswer $testAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestAnswer $testAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestAnswer $testAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestAnswer $testAnswer)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EnrollmentController extends Controller
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
    public function store(Request $request):Enrollment
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'course_id' => 'required|integer',
            'progress' => 'required|array',
            'status' => 'required|string',
        ]);

        // Check for existing enrollment based on user_id and course_id
        $enrollment = Enrollment::firstOrCreate(
            ['user_id' => $data['user_id'], 'course_id' => $data['course_id']],
            $data
        );

        return $enrollment;
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Enrollment $enrollment)
    {
        $data = $request->validate([
            'progress' => 'required|array',
            'status' => 'required|string',
        ]);

        $enrollment = Enrollment::find($enrollment);

        if (!$enrollment) {
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        $enrollment->update($data);

        return response()->json($enrollment, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function complete(Request $request,Enrollment $enrollment)
    {
        $data = $request->validate([
            'progress' => 'required|array',
            'status' => 'required|string',
        ]);

        $enrollment = Enrollment::find($enrollment);

        if (!$enrollment) {
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        $data['completed_date'] = Carbon::now();

        $enrollment->update($data);

        return $enrollment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        //
    }
}

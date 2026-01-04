<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Offering;
class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $request->validate(['student_id' => 'required|exists:students,id']);
        return Enrollment::where('student_id', $request->student_id)
                         ->with('offering.course', 'offering.professor')
                         ->get();
    }
    /**
     * Store a newly created resource in storage.
     */
// app/Http/Controllers/EnrollmentController.php

public function store(Request $request) {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'offering_id' => 'required|exists:offerings,id',
        ]);

        $offering = Offering::findOrFail($request->offering_id);

        if ($offering->enrollments()->count() >= $offering->capacity) {
            return response()->json(['error' => 'ظرفیت این ارائه تکمیل است.'], 400); // 
        }

        $alreadyEnrolled = Enrollment::where('student_id', $request->student_id)
                                     ->where('offering_id', $request->offering_id)
                                     ->exists();
        if ($alreadyEnrolled) {
            return response()->json(['error' => 'شما قبلاً در این ارائه ثبت‌نام کرده‌اید.'], 400); // [cite: 54]
        }

        $courseAlreadyTaken = Enrollment::where('student_id', $request->student_id)
            ->whereHas('offering', function($query) use ($offering) {
                $query->where('course_id', $offering->course_id)
                      ->where('term', $offering->term);
            })->exists();

        if ($courseAlreadyTaken) {
            return response()->json(['error' => 'شما این درس را در این ترم با استاد دیگری اخذ کرده‌اید.'], 400);
        }

        return Enrollment::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

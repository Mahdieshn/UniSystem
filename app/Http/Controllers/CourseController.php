<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return Course::all(); 
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:courses',
            'unit_count' => 'required|integer'
        ]);

        return Course::create($validated); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return response()->json($course, 200);
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
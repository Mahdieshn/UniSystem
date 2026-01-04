<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offering;
use App\Models\Course;
use App\Models\Professor;
class OfferingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
    $validated = $request->validate([
    'course_id' => 'required|exists:courses,id',
    'professor_id' => 'required|exists:professors,id',
    'term' => 'required|string',
    'capacity' => 'required|integer|min:1'
    ]);

    return Offering::create($validated);
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

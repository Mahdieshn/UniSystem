<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Professor::all(), 200); 
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255']);

        $professor = Professor::create($validated);
        return response()->json($professor, 201); 
    }
    /**
     * Display the specified resource.
     */
    public function show(Professor $professor)
    {
        return response()->json($professor, 200);
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

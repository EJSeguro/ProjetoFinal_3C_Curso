<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $experience = Experience::where('user_id', $id)->get();
        return response()->json($experience);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'company' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::user()->id;

        $experience = Experience::create($validated);

        return response()->json($experience, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        return response()->json($experience);
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'nullable|string',
            'company' => 'sometimes|string',
            'start_date' => 'sometimes|date',
            'end_date' => 'nullable|date',
        ]);

        $experience->update($validated);
        return response()->json([
            'message' => 'Academic background updated successfully',
            'data' => $experience
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $user = Auth::user()->id;
        if($user != $experience->user_id){
            return response()->json(['message' => 'You are not authorized to delete this academic background'], 401);
        }
        $experience->delete();
        return response()->json(['message' => 'Academic background deleted successfully'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AcademicBackground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcademicBackgroundController extends Controller
{

    public function index($id)
    {
        $academicBackgrounds = AcademicBackground::where('user_id', $id)->get();
        return response()->json($academicBackgrounds);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'institution' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'sometimes|date',
        ]);

        $validated['user_id'] = Auth::user()->id;

        $academicBackground = AcademicBackground::create($validated);

        return response()->json($academicBackground, 201);
    }

    public function show(AcademicBackground $academicBackground)
    {
        return response()->json($academicBackground);
    }

    public function update(Request $request, academicBackground $academicBackground)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'nullable|string',
            'institution' => 'sometimes|string',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date',
        ]);

        $academicBackground->update($validated);
        return response()->json([
            'message' => 'Academic background updated successfully',
            'data' => $academicBackground
        ], 200);
    }

    public function destroy(AcademicBackground $academicBackground)
    {
        $user = Auth::user()->id;
        if($user != $academicBackground->user_id){
            return response()->json(['error' => 'You are not authorized to delete this academic background'], 401);
        }
        $academicBackground->delete();
        return response()->json(['message' => 'Academic background deleted successfully'], 200);
    }
}

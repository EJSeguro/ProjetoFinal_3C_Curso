<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{

    public function index()
    {
        $vacancies = Vacancy::all();

        return response()->json($vacancies);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'image' => 'required|string',
            'field' => 'required|string',
            'location' => 'required|string',
            'active' => 'required|boolean',
        ]);

        $validated['user_id']= Auth::user()->id;
        $vaccancie = Vacancy::create($validated);

        return response()->json(['message' => 'Vacancy created successfully', $vaccancie], 201);
    }

    public function show(int $id)
    {
        $vacancy = Vacancy::findOrFail($id);

        return response()->json($vacancy);
    }

    public function update(Request $request, int $id)
    {
        $vacancy = Vacancy::where('user_id', Auth::user()->id)->findOrFail($id);

        $validated = $request->validate([
            'title'=> 'sometimes|string',
            'description'=> 'sometimes|string',
            'category'=> 'sometimes|string',
            'image'=> 'sometimes|string',
            'field'=> 'sometimes|string',
            'location'=> 'sometimes|string',
            'active'=> 'sometimes|boolean',
        ]);

        $vacancy->update($validated);

        return response()->json($vacancy, 200);
    }

    public function destroy(int $id)
    {
        $vacancy = Vacancy::where('user_id', Auth::user()->id)->findOrFail($id);

        $vacancy->delete();

        return response()->json(['message'=> 'Vacancy deleted successfully'], 200);
    }
}
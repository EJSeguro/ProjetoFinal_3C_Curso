<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexApplicationsVacancy($vacancyId)
    {
        $applications = Application::whereHas('vacancy', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->where('vacancy_id', $vacancyId)->all();

        return response()->json($applications);
    }

    public function indexApplicationsAll()
    {
        $applications = Application::whereHas('vacancy', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->all();

        return response()->json($applications);
    }

    public function indexApplicationsCandidate()
    {
        $applications = Application::where('user_id', Auth::user()->id)->all();

        return response()->json($applications);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id'
        ]);

        $validate['user_id'] = Auth::user()->id;

        $application = Application::create($validate);

        return response()->json($application, 200);
    }

    public function destroy(int $id)
    {
        $application = Application::where('user_id', Auth::user()->id)->firstOrFail($id);
        $application->delete();
        return response()->json($application, 200);
    }
}

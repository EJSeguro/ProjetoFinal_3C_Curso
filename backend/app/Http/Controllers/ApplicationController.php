<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function getApplicationsFromVacancy($vacancyId)
    {
        $applications = Application::whereHas('vacancy', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->where('vacancy_id', $vacancyId)->all();

        return response()->json($applications);
    }

    public function getAllApplicationsFromAllVacancies()
    {
        $applications = Application::whereHas('vacancy', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->all();

        return response()->json($applications);
    }

    public function getCandidateApplications()
    {
        $applications = Application::where('user_id', Auth::user()->id)->all();

        return response()->json($applications);
    }

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

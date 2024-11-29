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
        })->where('vacancy_id', $vacancyId)->get();

        return response()->json($applications);
    }

    public function getAllApplicationsFromAllVacancies()
    {
        $applications = Application::whereHas('vacancy', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();

        return response()->json($applications);
    }

    public function getCandidateApplications()
    {
        $applications = Application::where('user_id', Auth::user()->id)->with('vacancy')->get();

        return response()->json($applications);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id'
        ]);

        $validate['user_id'] = Auth::user()->id;

        $application = Application::where('vacancy_id', $validate['vacancy_id'])->where('user_id', $validate['user_id'])->first();

        if($application) {
            return response()->json(['message' => 'Application already exists'], 400);
        }

        $application = Application::create($validate);

        return response()->json($application, 200);
    }

    public function destroy(int $id)
    {
        $application = Application::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();
        $application->delete();
        return response()->json($application, 200);
    }
}

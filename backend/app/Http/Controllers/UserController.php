<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function changeRole()
    {
        $user = Auth::user();

        $user->role = $user->role == User::CANDIDATE_ROLE ? User::RECRUITER_ROLE : User::CANDIDATE_ROLE;

        return response()->json(['message' => 'Role changed successfully', 'data' => $user->role, 200]);
    }


    public function deleteProfile()
    {
        $user = Auth::user();
        $user->delete();
        return response()->json(['message' => 'User deleted successfully', 200]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show(int $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $valdiated = $request->validate([
            'about' => 'sometimes|string',
            'curriculum'=>'sometimes|string',
            'profileImg'=>'sometimes|string',
            'backgroundProfileImg'=>'sometimes|string',

        ]);

        $user=Auth::user();
        $user->update($valdiated);
        return response()->json(['message' => 'Profile updated successfully', 'data' => $user, 200]);
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

<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|in:profile,cover,vacancy',
            'vacancyId' => 'required_if:type,vacancy|exists:vacancies,id'
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $user->id . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();

            switch ($validated['type']) {
                case 'profile':
                    $path = $file->storeAs('uploads/profile', $filename, 'public');
                    $user->profileImg = $path;
                    $user->save();
                    break;

                case 'cover':
                    $path = $file->storeAs('uploads/cover', $filename, 'public');
                    $user->backgroundProfileImg = $path;
                    $user->save();
                    break;

                case 'vacancy':
                    if ($validated['vacancyId']) {
                        $vacancy = Vacancy::where('user_id', $user->id)->where('id', $validated['vacancyId'])->first();

                        if (!$vacancy) {
                            return response()->json(['error' => 'Invalid vacancy'], 400);
                        }
                        $filename = $vacancy->id . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();

                        $path = $file->storeAs('uploads/vacancy', $filename, 'public');
                        $vacancy->image = $path;
                        $vacancy->save();
                    }
                    break;

                default:
                    return response()->json(['error' => 'Invalid type provided'], 400);
            }

            return response()->json([
                'message' => 'Image uploaded successfully',
                'user' => $user,
                'path' => $path,
            ], 201);
        }

        return response()->json(['message' => 'No image uploaded'], 400);
    }

    public function getImage($type, $id)
    {
        $user = Auth::user();

        switch ($type) {
            case 'profile':
                $imagePath = $user->id === (int) $id ? $user->profileImg : null;
                break;

            case 'cover':
                $imagePath = $user->id === (int) $id ? $user->backgroundProfileImg : null;
                break;

            case 'vacancy':
                $vacancy = Vacancy::where('user_id', $user->id)->where('id', $id)->first();
                $imagePath = $vacancy ? $vacancy->image : null;
                break;

            default:
                return response()->json(['error' => 'Invalid image type'], 400);
        }

        if (!$imagePath) {  //!Storage::exists($imagePath) verificar
            return response()->json(['error' => 'Image not found'], 404);
        }

        $imageUrl = asset('storage/' . $imagePath);
        return response()->json(['url' => $imageUrl], 200);
        // return response()->file(storage_path('app/public/' . $imagePath));
    }

}

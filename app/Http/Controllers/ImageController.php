<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function storeImage(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = $request->user();
        // dd($user);
        $fileName = $user->id . '_' . Carbon::now()->timestamp . '.jpg';
        // dd($fileName);
        $imagePath = 'Img/AVT/';
        $imageContent = file_get_contents($request->file('avatar')->getRealPath());

        Storage::disk('public')->put($imagePath . $fileName, $imageContent);
        $user->update(['avatar' => $fileName]);
        return response()->json(['message' => 'Image stored and avatar field updated successfully']);
    }
}

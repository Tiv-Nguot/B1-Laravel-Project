<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function myProfile(Request $request){
        $user = $request->user();
        $user = new ProfileResource($user);
        return response()->json([
            'message' => ' success',
            'profile' => $user,
        ]);
    }
    public function updateImage(Request $request)
    {
        $user = $request->user();
    
        // Check if the request has a file named 'image_profile'
        if ($request->hasFile('image_profile')) {
            $image = $request->file('image_profile');
    
            // Generate a unique image name
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            // Move the uploaded file to the 'public/images' directory
            $image->move(public_path('images'), $imageName);
    
            // Update the user's image_profile field with the new image path
            $user->image_profile = 'images/' . $imageName;
    
            // Save the updated user record
            $user->save();
        } else {
            // Handle case where no image file is uploaded
            return response()->json([
                'error' => 'No image file uploaded.',
            ], 400);
        }
    
        // Return a JSON response with success message and updated profile data
        return response()->json([
            'message' => 'Profile updated successfully',
            'profile' => new ProfileResource($user),
        ]);
    }
}

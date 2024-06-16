<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\ForgotResetPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    //
    public function reset(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
        ]);

        try{
            $passwordReset = ForgotResetPassword::where([
            ['token', $request->token],
            ['email', $request->email],
        ])->first();

        // Validate the token
        if (!$passwordReset) {
            throw ValidationException::withMessages([
                'email' => ['The provided password reset token is invalid.'],
            ]);
        }

        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Optionally delete the password reset record
        $passwordReset->delete();

        // Return a response indicating success
        return response()->json(['message' => 'Password has been reset successfully.']);
        }catch (\Exception  $e) {
            return response()->json([
               'message' => "against password reset"
            ]);
        }
        
    }
}

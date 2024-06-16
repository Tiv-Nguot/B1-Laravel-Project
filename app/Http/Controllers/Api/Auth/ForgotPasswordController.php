<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\ForgotResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Add this line for logging
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {

        $request->validate(['email' => 'required|email']);

        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                throw ValidationException::withMessages([
                    'email' => ['The provided email address does not exist.'],
                ]);
            }

            // Create or update the password reset token
            $token = Str::random(60);
            $passwordReset = ForgotResetPassword::updateOrCreate(
                ['email' => $user->email],
                ['token' => $token]
            );

            // Send the password reset email
            if ($user && $passwordReset) {
                Password::sendResetLink(['email' => $user->email]);
            }

            // Return a success response
            return response()->json([
                'message' => 'We have e-mailed your password reset link!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'again',
            ]);
        };
    }
}

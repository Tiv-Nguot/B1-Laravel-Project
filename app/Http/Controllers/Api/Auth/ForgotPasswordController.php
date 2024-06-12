<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function sendOtp(Request $request)
    {
        // Generate OTP
        $otp = rand(1000, 9999);

    }
}

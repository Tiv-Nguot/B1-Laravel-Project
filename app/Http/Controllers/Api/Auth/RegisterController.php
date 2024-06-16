<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::register($request);
        $user->assignRole('user');
        $permissions = Permission::whereIn('name', ['view_users', 'view_roles', 'view_permissions'])->get();
        $user->givePermissionTo($permissions);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'       => 'Registration success',
            'access_token'  => $token,
            'token_type'    => 'Bearer',
        ]);
    }
}

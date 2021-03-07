<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
//            return Auth::guard('admin-api')->user();
            $accessToken = Auth::guard('admin')->user()->createToken('authToken',['admin'])->accessToken;
            return response()->json([
                'success' => true,
                'message' => 'Login success',
                'access_token' => $accessToken,
            ],Response::HTTP_ACCEPTED);
        }

        return response()->json([
            'success' => false,
            'message' => 'email or password incorrect',
        ],Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'success' => true,
            'message' => 'Logout successfully'
        ]);
    }

    public function getAllAdmins()
    {
        return Admin::all();
    }

    public function getLoggedUserDetails()
    {
        return auth('admin-api')->user();
    }
}

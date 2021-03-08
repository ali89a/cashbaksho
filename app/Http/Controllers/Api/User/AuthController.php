<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
//        return $request->all();
        $validator = Validator::make($request->all(), [
            'shop_name' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        DB::beginTransaction();

        try {
            $shop = Shop::create([
                'name' => $request->shop_name,
            ]);
            $request['password'] = Hash::make($request['password']);
            $user = User::create([
                'shop_id' => $shop->id,
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password'],
            ]);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong!',
                ],Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $accessToken = $user->createToken('authToken',['user'])->accessToken;

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

        return response()->json([
            'success' => true,
            'message' => 'Registration success',
            'access_token' => $accessToken,
        ],Response::HTTP_CREATED);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $accessToken = Auth::guard('user')->user()->createToken('authToken',['user'])->accessToken;

            return response()->json([
                'success' => true,
                'message' => 'Login success',
                'access_token' => $accessToken,
            ],Response::HTTP_ACCEPTED);
        }

        return response()->json([
            'success' => false,
            'errors' => 'email or password incorrect',
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

    public function getAllUsers()
    {
        return User::all();
    }

    public function getLoggedUserDetails()
    {
        return auth('user-api')->user();
    }
}

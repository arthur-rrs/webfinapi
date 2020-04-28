<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Model\Account;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $input = $request->validated();
        $newPassword = Hash::make($input['password']);
        $input['password'] = $newPassword;
        $user = new User($input);
        $user->save();
        $account = new Account();
        $account->user_id = $user->id;
        $account->name = 'Carteira';
        $account->save(); 
        return response()->json($user, 201);
    }

    public function login(LoginRequest $request)
    {
        $input = $request->all();
        $is = Auth::guard('web')->attempt($input);;
        if (!$is) {
            return response()->json([], 403);
        }
        $user = Auth::guard('web')->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'user' => $user,
            'token' => $tokenResult->accessToken,
        ], 200);
    }

}

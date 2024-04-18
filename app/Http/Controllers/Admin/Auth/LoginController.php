<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return Response::validationError(null, __('api.'));
        }
        // $token = auth()->user()->createToken('admin')->plainTextToken;

        // return response()->json([
        //     'token' => $token,
        // ]);
    }
}

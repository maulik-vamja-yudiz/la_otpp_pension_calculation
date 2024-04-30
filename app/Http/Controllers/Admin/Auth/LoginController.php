<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $admin = Admin::where([
                ['email', $request->email],
            ])->withTrashed()->first();

            if ($admin->trashed()) return Response::validationError(__('auth.deactivated'));

            if (Hash::check($request->password, $admin->password) === false) return Response::validationError(__('auth.password'));

            $token = $admin->createToken('auth_token')->plainTextToken;
            return Response::success(new AdminResource($admin), __('api.login'), HttpResponse::HTTP_OK, ['auth_token' => $token]);
        } catch (\Throwable $th) {
            return Response::exception($th->getMessage());
        }
    }

    public function logout()
    {
        try {
            // Revoke the token that was used to authenticate the current request...
            request()->user()->currentAccessToken()->delete();
            return Response::success(null, __('api.logout'));
        } catch (\Throwable $th) {
            return Response::exception($th->getMessage());
        }
    }
}

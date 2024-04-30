<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\UpdateProfileRequest;
use App\Http\Resources\Admin\AdminResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class ProfileController extends Controller
{
    public function getProfile()
    {
        try {
            return response()->success(new AdminResource(auth()->user()), __('api.get', ['entity' => __('Profile')]));
        } catch (\Throwable $th) {
            return response()->exception($th->getMessage());
        }
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        try {

            $admin = DB::transaction(function () use ($request) {
                $admin = auth()->user();
                $request['profile'] = imageUpload($request, 'profile_photo', 'admin/profile', $admin->getRawOriginal('profile'));
                $admin->update($request->all());
                return $admin;
            });

            // If Email is changed then logout the user
            if ($admin->wasChanged('email')) {
                // Send the email verification notification to the Admin
                $admin->sendEmailVerificationNotification();

                // Revoke the token that was used to authenticate the current request...
                $admin->currentAccessToken()->delete();
                return response()->success(null, __('api.email_update'), Response::HTTP_UNAUTHORIZED);
            }

            return response()->success(new AdminResource($admin), __('api.get', ['entity' => __('Profile')]));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->exception($th->getMessage());
        }
    }
}

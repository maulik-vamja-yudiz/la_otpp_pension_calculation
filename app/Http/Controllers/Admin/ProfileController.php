<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\UpdateProfileRequest;
use App\Http\Resources\Admin\AdminResource;
use Illuminate\Http\Request;

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
            $admin = auth()->user();
            // if ($request->hasFile('profile')) {
            //     $admin->deleteImage();
            //     $admin->profile = $admin->uploadImage($request->file('profile'));
            // }
            $admin->update($request->all());
            return response()->success(new AdminResource($admin), __('api.get', ['entity' => __('Profile')]));
        } catch (\Throwable $th) {
            return response()->exception($th->getMessage());
        }
    }
}

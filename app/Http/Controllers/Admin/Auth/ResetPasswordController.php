<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\{ForgetPasswordRequest, ResetPasswordRequest};
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    // public function forgetPassword(ForgetPasswordRequest $request)
    // {
    //     try {

    //         $resetLinkStatus = Password::broker('admins')->sendResetLink($request->only('email'));
    //         dd($resetLinkStatus);
    //         if ($resetLinkStatus !== Password::RESET_LINK_SENT) {
    //             return response()->exception(__('api.something_went_wrong'));
    //         }

    //         return response()->success(null, __('api.forget_password'));
    //     } catch (\Throwable $th) {
    //         dd($th->getMessage());
    //         return response()->exception($th->getMessage());
    //     }
    // }

    // public function resetPassword(ResetPasswordRequest $request)
    // {
    //     try {
    //         return response()->success(null, __('api.reset_password'));
    //     } catch (\Throwable $th) {
    //         return response()->exception($th->getMessage());
    //     }
    // }

    use ResetsPasswords;

    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function broker()
    {
        return Password::broker('admins');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}

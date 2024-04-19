<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        $response = [
            'data'  => null,
            'meta'  => [
                'message' => null,
                'url'   => url()->current(),
            ]
        ];

        Response::macro('success', function ($data = null, $message, $headers = [], $statusCode = 200,) use ($response) {
            $response['meta']['message'] = $message;
            $response['data'] = $data;
            return response()->json($response, $statusCode, $headers);
        });

        Response::macro('validationError', function ($message, $statusCode = 422) use ($response) {
            $response['meta']['message'] = $message;
            return response()->json($response, $statusCode);
        });

        Response::macro('exception', function ($message, $statusCode = 500) use ($response) {
            return response()->json($response['meta']['message'] = $message ?? __('api.something_went_wrong'), $statusCode);
        });
    }
}

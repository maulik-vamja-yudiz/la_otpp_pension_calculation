<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as PasswordsCanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model implements CanResetPassword
{
    use HasFactory, HasUuids, SoftDeletes, HasApiTokens, Authenticatable, Notifiable, PasswordsCanResetPassword;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'contact_no',
        'profile',
        'is_active',
        'type',
        'email_verified_at',
    ];

    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];

    /* Accessor & Mutator */
    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1 ? true : false,
        );
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    protected function profile(): Attribute
    {
        return Attribute::make(
            get: fn ($value = null) => generate_url($value),
        );
    }

    // Add the missing methods
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}

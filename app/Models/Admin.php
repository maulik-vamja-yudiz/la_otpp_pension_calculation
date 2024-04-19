<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasApiTokens;

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
}

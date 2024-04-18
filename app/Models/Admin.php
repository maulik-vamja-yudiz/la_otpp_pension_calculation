<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
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
        'is_status',
        'type',
        'email_verified_at',
    ];
}

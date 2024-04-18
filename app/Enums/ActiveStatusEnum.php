<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum ActiveStatusEnum: int
{
    case ACTIVE = 1;
    case INACTIVE = 0;

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $status) => [
                $status->value => Str::lower($status->value),
            ])->toArray();
    }
}

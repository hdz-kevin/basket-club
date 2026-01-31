<?php

namespace App\Enums;

enum PlayerGender: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';

    /**
     * Returns an array of all the values of the enum
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return collect(self::cases())
                ->map(fn(self $case) => $case->value)
                ->toArray();
    }
}

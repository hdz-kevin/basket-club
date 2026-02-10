<?php

namespace App\Enums;

enum TeamGender: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case MIX = 'mix';

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

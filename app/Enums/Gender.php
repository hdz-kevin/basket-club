<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';

    /**
     * Get the list of gender values.
     *
     * @return string[]
     */
    public static function values(): array
    {
        return array_map(fn (self $gender) => $gender->value, self::cases());
    }
}

<?php

namespace App\Enums;

enum TeamCategory: string
{
    case PREBENJAMINES = 'prebenjamines';
    case BENJAMINES = 'benjamines';
    case ALEVINES = 'alevines';
    case INFANTILES = 'infantiles';
    case CADETES = 'cadetes';
    case JUNIOR = 'junior';
    case SENIOR = 'senior';

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

<?php

namespace App\Enums;

enum TeamCategory: string
{
    case Prebenjamines = "prebenjamines";
    case Benjamines = "benjamines";
    case Alevines = "alevines";
    case Infantiles = "infantiles";
    case Cadete = "cadete";
    case Junior = "junior";
    case Senior = "senior";

    /**
     * Get the list of TeamCategory values.
     *
     * @return string[]
     */
    public static function values(): array
    {
        return array_map(fn (self $category) => $category->value, self::cases());
    }
}

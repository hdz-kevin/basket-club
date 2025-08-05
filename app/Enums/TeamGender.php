<?php

namespace App\Enums;

enum TeamGender: string
{
    case Male = "male";
    case Female = "female";
    case Mix = "mix";

    /**
     * Get the list of TeamGender values.
     *
     * @return string[]
     */
    public static function values(): array
    {
        return array_map(fn (self $gender) => $gender->value, self::cases());
    }
}

<?php

namespace App\Enums;

enum MeasureEnum: string
{
    case G = "Gramas";
    case KG = "Quilo";
    case ML = "Mililitro";
    case L = "Litro";
    case UND = "Unidade";

    public static function fromValue(string $name): string
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status->value;
            }
        }

        throw new \ValueError("$status is not a valid");
    }

    public static function toArray()
    {
        return [
            self::G,
            self::KG,
            self::L,
            self::ML
        ];
    }
}
<?php

use App\Enums\MeasureEnum;

if (!function_exists('getMeasure')) {
    function getMeasure(string $measure): string
    {
        return MeasureEnum::fromValue($measure);
    }
}

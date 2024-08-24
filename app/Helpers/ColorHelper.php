<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use App\Models\Technician;

class ColorHelper
{
    public static function pickUniqueColor()
    {
        $cacheKey = 'existing_colors';
        $previousColorKey = 'previous_color';

        if (Cache::has($cacheKey)) {
            $existingColors = Cache::get($cacheKey);
        } else {
            $existingColors = Technician::distinct()->pluck('color')->toArray();
            Cache::put($cacheKey, $existingColors, now()->addHours(24));
        }

        $previousColor = Cache::get($previousColorKey);

        if ($previousColor && !in_array($previousColor, $existingColors)) {
            $color = $previousColor;
        } else {
            do {
                $color = self::generateRandomColor();
            } while (in_array($color, $existingColors));
        }

        $color = strtolower($color);
        Cache::put($previousColorKey, $color, now()->addMinutes(60)); // Cache for 60 minutes

        return $color;
    }

    private static function generateRandomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}

<?php

namespace backend\helpers;

class GeoHelper
{
    public static function CalculateDistance(string $cep1, string $cep2)
    {
        $lat1 = intval(substr(preg_replace('/\D/', '', $cep1), 0, 3));
        $lat2 = intval(substr(preg_replace('/\D/', '', $cep2), 0, 3));
        return abs($lat1 - $lat2) * 1.2;
    }
}

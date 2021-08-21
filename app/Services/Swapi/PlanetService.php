<?php

namespace App\Services\Swapi;

use App\Models\Planet;
use Illuminate\Support\Facades\Http;

class PlanetService
{
    public static function retrieveData($url)
    {
        $planet = Planet::whereUrl($url)->first();

        if(is_null($planet)) {
            $api = Http::get($url)->json();

            $planet = Planet::create($api);
        }

        return $planet;
    }
}

<?php

namespace App\Services\Swapi;

use App\Models\People;
use Illuminate\Support\Facades\Http;

class PeopleService
{
    public static function retrieveData()
    {
        $peoples = self::call('https://swapi.dev/api/people');

        foreach ($peoples as $people) {
            $planet = PlanetService::retrieveData($people['homeworld']);

            People::firstOrCreate([
                'planet_id' => $planet->id,
                'name' => $people['name'],
                'birth_year' => $people['birth_year'],
                'eye_color' => $people['eye_color'],
                'gender' => $people['gender'],
                'hair_color' => $people['hair_color'],
                'height' => $people['height'],
                'mass' => $people['mass'],
                'skin_color' => $people['skin_color'],
            ]);
        }
    }

    /**
     * @param string $url
     * @return array
     */
    private static function call(string $url)
    {
        $api = Http::get($url)->json();
        $peoples = [];

        if(!is_null($api['next'])) {
            $peoples = self::call($api['next']);
        }

        return array_merge($peoples, $api['results']);
    }

}

<?php

namespace Tests\Unit;

use App\Models\People;
use App\Models\Planet;
use Tests\TestCase;

class PeopleTest extends TestCase
{
    /** @test */
    public function it_belong_to_a_planet()
    {
        $planet = Planet::factory()->create();

        $people = People::factory()->create([
            'planet_id' => $planet->id
        ]);

        $this->assertInstanceOf(Planet::class, $people->planet);
    }
}

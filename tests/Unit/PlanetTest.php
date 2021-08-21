<?php

namespace Tests\Unit;

use App\Models\People;
use App\Models\Planet;
use Tests\TestCase;

class PlanetTest extends TestCase
{
    /** @test */
    public function it_has_people()
    {
        $planet = Planet::factory()->create();

        People::factory()->create([
            'planet_id' => $planet->id
        ]);

        $this->assertInstanceOf(People::class, $planet->peoples->first());
    }
}

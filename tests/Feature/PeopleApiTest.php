<?php

namespace Tests\Feature;

use App\Models\People;
use App\Models\Planet;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PeopleApiTest extends TestCase
{
    /** @test */
    public function it_possible_view_people()
    {
        $people = People::factory(5)->create();

        $this->get(route('people.index'))
            ->assertOk()
            ->assertJsonCount(5,'data')
            ->assertJsonFragment([
                'name' => $people->first()->name,
                'birth_year' => $people->first()->birth_year,
                'eye_color' => $people->first()->eye_color,
                'gender' => $people->first()->gender,
                'hair_color' => $people->first()->hair_color,
                'height' => $people->first()->height,
                'mass' => $people->first()->mass,
                'skin_color' => $people->first()->skin_color
            ]);
    }

    /** @test */
    public function it_possible_filtering_people()
    {
        People::factory(5)->create();

        $search = People::first();

        $this->get(route('people.index', ['search' => $search->name]))
            ->assertOk()
            ->assertJsonCount(1,'data')
            ->assertJsonFragment([
                'name' => $search->name,
                'birth_year' => $search->birth_year,
                'eye_color' => $search->eye_color,
                'gender' => $search->gender,
                'hair_color' => $search->hair_color,
                'height' => $search->height,
                'mass' => $search->mass,
                'skin_color' => $search->skin_color
            ]);
    }

    /** @test */
    public function it_possible_view_people_detailed_information()
    {
        $planet = Planet::factory()->create();
        $people = People::factory()->create([
            'planet_id' => $planet
        ]);

        $this->get(route('people.show', compact('people')))
            ->assertOk()
            ->assertJsonFragment([
                'planet_id' => $planet->id,
                'name' => $people->name,
                'birth_year' => $people->birth_year,
                'eye_color' => $people->eye_color,
                'gender' => $people->gender,
                'hair_color' => $people->hair_color,
                'height' => $people->height,
                'mass' => $people->mass,
                'skin_color' => $people->skin_color
            ]);
    }
}

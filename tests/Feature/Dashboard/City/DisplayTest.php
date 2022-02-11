<?php

namespace Tests\Feature\Dashboard\City;

use Tests\TestCase;
use App\Models\City;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_list_of_cities()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.cities.index'));

        $response->assertSuccessful();
    }

    /** @test */
    public function it_can_display_city_details()
    {
        $this->be(factory(Admin::class)->create());

        $city = factory(City::class)->create();

        $response = $this->get(route('dashboard.cities.show', $city));

        $response->assertSuccessful();

        $response->assertSee($city->name);
    }
}

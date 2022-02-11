<?php

namespace Tests\Feature\Dashboard\Country;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_list_of_countries()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.countries.index'));

        $response->assertSuccessful();
    }

    /** @test */
    public function it_can_display_country_details()
    {
        $this->be(factory(Admin::class)->create());

        $country = factory(Country::class)->create();

        $response = $this->get(route('dashboard.countries.show', $country));

        $response->assertSuccessful();

        $response->assertSee($country->name);
    }
}

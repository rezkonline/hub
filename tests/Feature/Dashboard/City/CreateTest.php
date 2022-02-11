<?php

namespace Tests\Feature\Dashboard\City;

use Tests\TestCase;
use App\Models\City;
use App\Models\Admin;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_city_create_form()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.cities.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('cities.actions.create'));
    }

    /** @test */
    public function it_can_create_cities()
    {
        $this->be(factory(Admin::class)->create());

        $country = factory(Country::class)->create();

        $citiesCount = City::count();

        $response = $this->post(route('dashboard.cities.store'), [
            'name:ar' => 'القاهرة',
            'name:en' => 'Cairo',
            'country_id' => $country->id,
        ]);

        $response->assertRedirect();

        $this->assertEquals(City::count(), $citiesCount + 1);

        $this->assertEquals(City::latest('id')->first()->{'name:ar'}, 'القاهرة');
        $this->assertEquals(City::latest('id')->first()->{'name:en'}, 'Cairo');
    }
}

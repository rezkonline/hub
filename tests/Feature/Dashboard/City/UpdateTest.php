<?php

namespace Tests\Feature\Dashboard\City;

use Tests\TestCase;
use App\Models\City;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_city_edit_form()
    {
        $this->be(factory(Admin::class)->create());

        $city = factory(City::class)->create();

        $response = $this->get(route('dashboard.cities.edit', $city));

        $response->assertSuccessful();

        $response->assertSee(trans('cities.actions.edit'));
    }

    /** @test */
    public function it_can_update_cities()
    {
        $this->be(factory(Admin::class)->create());

        $city = factory(City::class)->create();

        $response = $this->put(route('dashboard.cities.update', $city), [
            'name:ar' => 'القاهرة',
            'name:en' => 'Cairo',
            'country_id' => $city->country_id,
        ]);

        $city->refresh();

        $this->assertEquals($city->{'name:ar'}, 'القاهرة');
        $this->assertEquals($city->{'name:en'}, 'Cairo');

        $response->assertRedirect();
    }
}

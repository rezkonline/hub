<?php

namespace Tests\Feature\Dashboard\Country;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_country_edit_form()
    {
        $this->be(factory(Admin::class)->create());

        $country = factory(Country::class)->create();

        $response = $this->get(route('dashboard.countries.edit', $country));

        $response->assertSuccessful();

        $response->assertSee(trans('countries.actions.edit'));
    }

    /** @test */
    public function it_can_update_countries()
    {
        $this->be(factory(Admin::class)->create());

        $country = factory(Country::class)->create();

        $response = $this->put(route('dashboard.countries.update', $country), [
            'name:ar' => 'مصر',
            'name:en' => 'Egypt',
            'key' => 'eg',
        ]);

        $response->assertRedirect();

        $country->refresh();

        $this->assertEquals($country->{'name:ar'}, 'مصر');
        $this->assertEquals($country->{'name:en'}, 'Egypt');
    }
}

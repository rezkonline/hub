<?php

namespace Tests\Feature\Dashboard\Country;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_user_create_form()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.countries.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('countries.actions.create'));
    }

    /** @test */
    public function it_can_create_countries()
    {
        $this->be(factory(Admin::class)->create());

        $countriesCount = Country::count();

        $response = $this->post(route('dashboard.countries.store'), [
            'name:ar' => 'مصر',
            'name:en' => 'Egypt',
            'key' => 'eg',
        ]);

        $response->assertRedirect();

        $this->assertEquals(Country::count(), $countriesCount + 1);

        $this->assertEquals(Country::latest('id')->first()->{'name:ar'}, 'مصر');
        $this->assertEquals(Country::latest('id')->first()->{'name:en'}, 'Egypt');
    }
}

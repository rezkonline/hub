<?php

namespace Tests\Feature\Dashboard\City;

use Tests\TestCase;
use App\Models\City;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_city()
    {
        $this->be(factory(Admin::class)->create());

        $country = factory(City::class)->create();

        $citiesCount = City::count();

        $response = $this->delete(route('dashboard.cities.destroy', $country));

        $response->assertRedirect();

        $this->assertEquals(City::count(), $citiesCount - 1);
    }
}

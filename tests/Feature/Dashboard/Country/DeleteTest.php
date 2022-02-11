<?php

namespace Tests\Feature\Dashboard\Country;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Country;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_country()
    {
        $this->be(factory(Admin::class)->create());

        $country = factory(Country::class)->create();

        $countiesCount = Country::count();

        $response = $this->delete(route('dashboard.countries.destroy', $country));

        $response->assertRedirect();

        $this->assertEquals(Country::count(), $countiesCount - 1);
    }
}

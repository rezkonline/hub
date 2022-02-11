<?php

namespace Tests\Feature\Dashboard\Package;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_list_of_packages()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.packages.index'));

        $response->assertSuccessful();
    }

    /** @test */
    public function it_can_display_package_details()
    {
        $this->be(factory(Admin::class)->create());

        $package = factory(Package::class)->create();

        $response = $this->get(route('dashboard.packages.show', $package));

        $response->assertSuccessful();

        $response->assertSee($package->name);
    }
}

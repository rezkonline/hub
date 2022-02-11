<?php

namespace Tests\Feature\Dashboard\Package;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_package_edit_form()
    {
        $this->be(factory(Admin::class)->create());

        $package = factory(Package::class)->create();

        $response = $this->get(route('dashboard.packages.edit', $package));

        $response->assertSuccessful();

        $response->assertSee(trans('packages.actions.edit'));
    }

    /** @test */
    public function it_can_update_packages()
    {
        $this->be(factory(Admin::class)->create());

        $package = factory(Package::class)->create();

        $response = $this->put(route('dashboard.packages.update', $package), [
            'name' => 'Package',
            'price' => '500',
        ]);

        $response->assertRedirect();

        $package->refresh();

        $response = $this->get(route('dashboard.packages.show', $package));

        $response->assertSee($package->price);
    }
}

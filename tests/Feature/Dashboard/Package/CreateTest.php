<?php

namespace Tests\Feature\Dashboard\Package;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_package_create_form()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.packages.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('packages.actions.create'));
    }

    /** @test */
    public function it_can_create_packages()
    {
        $this->be(factory(Admin::class)->create());

        $packagesCount = Package::count();

        $response = $this->post(route('dashboard.packages.store'), [
            'name:ar' => 'حزمة',
            'name:en' => 'Package',
            'price' => '299',
        ]);

        $response->assertRedirect();

        $this->assertEquals(Package::count(), $packagesCount + 1);
    }
}

<?php

namespace Tests\Feature\Dashboard\Package;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_package()
    {
        $this->be(factory(Admin::class)->create());

        $package = factory(Package::class)->create();

        $packagesCount = Package::count();

        $response = $this->delete(route('dashboard.packages.destroy', $package));

        $response->assertRedirect();

        $this->assertEquals(Package::count(), $packagesCount - 1);
    }
}

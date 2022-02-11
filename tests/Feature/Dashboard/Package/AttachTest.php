<?php

namespace Tests\Feature\Dashboard\Package;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Package;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttachTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_attach_package()
    {
        $this->be(factory(Admin::class)->create());

        $package = factory(Package::class)->create();

        $customer = factory(Customer::class)->create();

        $response = $this->put(route('dashboard.users.attachPackage', [ $customer, $package ]));

        $response->assertRedirect();

        $response = $this->get(route('dashboard.users.show', $customer));

        $response->assertSee($package->name);
    }
}

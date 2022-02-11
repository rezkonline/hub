<?php

namespace Tests\Feature\Dashboard\Report;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_customers_report()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.reports.customers'));

        $response->assertSuccessful();
    }
}

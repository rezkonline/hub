<?php

namespace Tests\Feature\Dashboard\Report;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FinancialTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_financial_report()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.reports.financial'));

        $response->assertSuccessful();
    }

    /** @test */
    public function it_can_display_financial_report_details()
    {
        $this->be(factory(Admin::class)->create());

        $transaction = factory(Transaction::class)->create();

        $response = $this->get(route('dashboard.reports.financial'));

        $response->assertSuccessful();

        $response->assertSee($transaction->amount);
    }
}

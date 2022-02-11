<?php

namespace Tests\Feature\Dashboard\Transaction;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_attach_transaction()
    {
        $this->be(factory(Admin::class)->create());

        $customer = factory(Customer::class)->create();

        $response = $this->post(route('dashboard.users.transactions.store', $customer), [
            'amount' => 599,
            'payment_type' => 'PayPal',
            'note' => 'Simple Note',
        ]);

        $response->assertRedirect();
    }
}

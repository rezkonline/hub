<?php

namespace Tests\Feature\Dashboard\Campaign;

use Tests\TestCase;
use App\Models\Campaign;
use App\Models\Customer;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_list_of_campaigns()
    {
        $customer = factory(Customer::class)->create();

        Sanctum::actingAs($customer);

        $response = $this->get(route('api.campaigns.index'));

        $response->assertOk();
    }

    /** @test */
    public function it_can_display_campaign_details()
    {
        $customer = factory(Customer::class)->create();

        Sanctum::actingAs($customer);

        $campaign = factory(Campaign::class)->create([
            'customer_id' => $customer->id,
        ]);

        $response = $this->get(route('api.campaigns.show', $campaign));

        $response->assertOk();
    }
}

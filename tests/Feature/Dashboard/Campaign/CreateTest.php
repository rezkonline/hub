<?php

namespace Tests\Feature\Dashboard\Campaign;

use App\Events\CampaignCreatedEvent;
use App\Notifications\CampaignCreatedNotifications;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\Customer;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_campaigns()
    {
        $this->be($customer = factory(Customer::class)->create());

        $campaignsCount = Campaign::count();

        Event::fake();

        $response = $this->post(route('api.campaigns.store'), [
            'name' => 'CampaignResource',
            'description' => 'Description',
            'target' => 300,
            'budget' => 200,
            'status' => Campaign::ONGOING_STATUS,
            'customer_id' => $customer->id,
        ]);

        $response->assertOk();

        Event::assertDispatched(CampaignCreatedEvent::class);

        $this->assertEquals(Campaign::count(), $campaignsCount + 1);
    }
}

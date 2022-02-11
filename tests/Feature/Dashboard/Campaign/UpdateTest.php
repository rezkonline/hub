<?php

namespace Tests\Feature\Dashboard\Campaign;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Campaign;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_update_campaigns()
    {
        $this->be(factory(Admin::class)->create());

        Event::fake();

        $campaign = factory(Campaign::class)->create();

        $response = $this->put(route('api.campaigns.update', $campaign), [
            'name' => 'CampaignResource',
            'description' => 'Description',
            'target' => 300,
            'budget' => 200,
            'status' => Campaign::COMPLETED_STATUS,
        ]);

        $response->assertOk();
    }
}

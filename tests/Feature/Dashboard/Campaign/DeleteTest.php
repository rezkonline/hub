<?php

namespace Tests\Feature\Dashboard\Campaign;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_campaign()
    {
        $this->be(factory(Admin::class)->create());

        $campaign = factory(Campaign::class)->create();

        $campaignsCount = Campaign::count();

        $response = $this->delete(route('api.campaigns.destroy', $campaign));

        $response->assertOk();

        $this->assertEquals(Campaign::count(), $campaignsCount - 1);
    }
}

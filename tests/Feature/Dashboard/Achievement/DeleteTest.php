<?php

namespace Tests\Feature\Dashboard\Achievement;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Achievement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_achievement()
    {
        $this->be(factory(Admin::class)->create());

        $achievement = factory(Achievement::class)->create();

        $user = factory(Customer::class)->create();

        $achievementCount = Achievement::count();

        $response = $this->delete(route('dashboard.users.achievements.destroy', [$user, $achievement]));

        $response->assertRedirect();

        $this->assertEquals(Achievement::count(), $achievementCount - 1);
    }
}

<?php

namespace Tests\Feature\Dashboard\Achievement;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Achievement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_achievements()
    {
        $this->be(factory(Admin::class)->create());

        $achievementsCount = Achievement::count();

        $user = factory(Customer::class)->create();

        $response = $this->post(route('dashboard.users.achievements.store', $user), [
            'title' => 'انجاز',
            'value' => '50',
            'customer_id' => $user->id,
        ]);

        $response->assertRedirect();

        $this->assertEquals(Achievement::count(), $achievementsCount + 1);
    }
}

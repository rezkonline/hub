<?php

namespace Tests\Feature\Dashboard\Achievement;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Achievement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_update_achievements()
    {
        $this->be(factory(Admin::class)->create());

        $achievement = factory(Achievement::class)->create();
        $user = factory(Customer::class)->create();

        $response = $this->put(route('dashboard.users.achievements.update', [$user, $achievement]), [
            'title' => 'Achievement',
            'value' => '404',
        ]);

        $response->assertRedirect();
    }
}

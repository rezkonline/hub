<?php

namespace Tests\Feature\Dashboard\Schedule;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Schedule;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_update_schedules()
    {
        $this->be(factory(Admin::class)->create());

        $schedule = factory(Schedule::class)->create();

        Event::fake();

        $response = $this->put(route('api.schedules.update', $schedule), [
            'name' => 'Schedule',
            'description' => 'Description',
            'status' => Schedule::COMPLETED_STATUS,
        ]);

        $response->assertOk();
    }
}

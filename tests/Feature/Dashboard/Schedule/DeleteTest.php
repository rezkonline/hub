<?php

namespace Tests\Feature\Dashboard\Schedule;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_schedule()
    {
        $this->be(factory(Admin::class)->create());

        $schedule = factory(Schedule::class)->create();

        $schedulesCount = Schedule::count();

        $response = $this->delete(route('api.schedules.destroy', $schedule));

        $response->assertOk();

        $this->assertEquals(Schedule::count(), $schedulesCount - 1);
    }
}

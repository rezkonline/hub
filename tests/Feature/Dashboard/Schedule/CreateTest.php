<?php

namespace Tests\Feature\Dashboard\Schedule;

use App\Events\ScheduleCreatedEvent;
use App\Notifications\ScheduleCreatedNotifications;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Schedule;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_schedules()
    {
        $this->be($customer = factory(Customer::class)->create());

        $schedulesCount = Schedule::count();

        Event::fake();

        $response = $this->post(route('api.schedules.store'), [
            'name' => 'Schedule',
            'description' => 'Description',
            'status' => Schedule::ONGOING_STATUS,
            'customer_id' => $customer->id,
        ]);

        $response->assertOk();

        Event::assertDispatched(ScheduleCreatedEvent::class);

        $this->assertEquals(Schedule::count(), $schedulesCount + 1);
    }
}

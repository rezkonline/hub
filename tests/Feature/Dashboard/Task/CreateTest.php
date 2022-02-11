<?php

namespace Tests\Feature\Dashboard\Task;

use App\Events\TaskCreatedEvent;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use App\Models\Task;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_tasks()
    {
        $this->be($customer = factory(Customer::class)->create());

        $tasksCount = Task::count();

        Event::fake();

        $response = $this->post(route('api.tasks.store'), [
            'name' => 'Task',
            'description' => 'Description',
            'status' => Task::ONGOING_STATUS,
            'customer_id' => $customer->id,
        ]);

        $response->assertOk();

        Event::assertDispatched(TaskCreatedEvent::class);

        $this->assertEquals(Task::count(), $tasksCount + 1);
    }
}

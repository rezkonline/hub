<?php

namespace Tests\Feature\Dashboard\Task;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Admin;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_update_tasks()
    {
        $this->be(factory(Admin::class)->create());

        $task = factory(Task::class)->create();

        Event::fake();

        $response = $this->put(route('api.tasks.update', $task), [
            'name' => 'Task',
            'description' => 'Description',
            'status' => Task::COMPLETED_STATUS,
        ]);

        $response->assertOk();
    }
}

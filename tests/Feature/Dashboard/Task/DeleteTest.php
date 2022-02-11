<?php

namespace Tests\Feature\Dashboard\Task;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_task()
    {
        $this->be(factory(Admin::class)->create());

        $task = factory(Task::class)->create();

        $tasksCount = Task::count();

        $response = $this->delete(route('api.tasks.destroy', $task));

        $response->assertOk();

        $this->assertEquals(Task::count(), $tasksCount - 1);
    }
}

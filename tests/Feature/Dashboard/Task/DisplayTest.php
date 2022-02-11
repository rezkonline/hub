<?php

namespace Tests\Feature\Dashboard\Task;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Admin;
use App\Models\Customer;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_list_of_tasks()
    {
        $customer = factory(Customer::class)->create();

        Sanctum::actingAs($customer);

        $response = $this->get(route('api.tasks.index'));

        $response->assertOk();
    }

    /** @test */
    public function it_can_display_task_details()
    {
        $customer = factory(Customer::class)->create();

        Sanctum::actingAs($customer);

        $task = factory(Task::class)->create([
            'customer_id' => $customer->id,
        ]);

        $response = $this->get(route('api.tasks.show', $task));

        $response->assertOk();
    }
}

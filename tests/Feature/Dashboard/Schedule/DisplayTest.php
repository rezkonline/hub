<?php

namespace Tests\Feature\Dashboard\Schedule;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Schedule;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisplayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_list_of_schedules()
    {
        $customer = factory(Customer::class)->create();

        Sanctum::actingAs($customer);

        $response = $this->get(route('api.schedules.index'));

        $response->assertOk();
    }

    /** @test */
    public function it_can_display_schedule_details()
    {
        $customer = factory(Customer::class)->create();

        Sanctum::actingAs($customer);

        $schedule = factory(Schedule::class)->create([
            'customer_id' => $customer->id,
        ]);

        $response = $this->get(route('api.schedules.show', $schedule));

        $response->assertOk();
    }
}

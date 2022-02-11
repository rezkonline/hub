<?php

namespace Tests\Feature\Dashboard\Settings;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_settings_update_form()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.settings.index'));

        $response->assertSuccessful();
    }

    /** @test */
    public function it_can_update_settings()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->post(route('dashboard.settings.store'), [
            'title' => 'Site Title',
        ]);

        $response->assertRedirect();
    }
}

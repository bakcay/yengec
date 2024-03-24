<?php

namespace Tests\Feature;

use App\Enums\Marketplace;
use App\Models\Integration;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithConsoleEvents;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IntegrationCommandTest extends TestCase {
    use RefreshDatabase;

    /** @test */
    public function an_integration_can_be_added_via_console() {


        $_marketplace = Marketplace::N11->value;
        $_username    = fake()->userName;
        $_password    = fake()->text(10); //complex characters cannot be passed via console

        $this->artisan('integration:add', [
            'marketplace' => $_marketplace,
            'username'    => $_username,
            'password'    => $_password,
        ])
        ->expectsOutput('Integration added successfully.')
        ->assertExitCode(0);

        $this->assertDatabaseHas('integrations', [
            'marketplace' => $_marketplace,
            'username'    => $_username,
        ]);

    }

    /** @test */
    public function an_integration_can_be_updated_via_console() {

        $_marketplace = Marketplace::Trendyol->value;
        $_username    = fake()->userName;
        $_password    = fake()->text(10); //complex characters cannot be passed via console
        $integration  = Integration::factory()->create();

        $this->artisan('integration:update', [
            'id'          => $integration->id,
            'marketplace' => $_marketplace,
            'username'    => $_username,
            'password'    => $_password,
        ])
        ->assertExitCode(0)
        ->expectsOutput('Integration updated successfully.');

        $this->assertDatabaseHas('integrations', [
            'marketplace' => $_marketplace,
            'username'    => $_username,
        ]);

    }

    /** @test */
    public function an_integration_can_be_deleted_via_console() {
        $integration = Integration::factory()->create();

        $this->artisan('integration:delete', [
            'id' => $integration->id,
        ])->assertExitCode(0);

        $this->assertDatabaseMissing('integrations', [
            'id' => $integration->id,
        ]);

    }

}

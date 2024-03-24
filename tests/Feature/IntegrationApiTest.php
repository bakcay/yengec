<?php

namespace Tests\Feature;

use App\Enums\Marketplace;
use App\Models\Integration;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IntegrationApiTest extends TestCase {

    use DatabaseMigrations;


    protected function setUp(): void {
        parent::setUp();


        \Artisan::call('passport:client', [
            '--personal'       => true,
            '--no-interaction' => true,
            '--name'           => 'TestPersonalClient',
        ]);


        $this->user = User::factory()
                          ->create();

        $this->token = $this->user->createToken('Personal Access Token')->accessToken;
    }

    /** @test */
    public function an_integration_can_be_added_via_api() {
        $this->withoutExceptionHandling();

        $_user = fake()->userName();
        $_pass = fake()->password();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
                         ->postJson(route('api.integration.store'), [
                             'marketplace' => Marketplace::N11->value,
                             'username'    => $_user,
                             'password'    => $_pass,
                         ]);

        $response->assertStatus(201);
        $response->assertJson([
            'marketplace' => Marketplace::N11->value,
            'username'    => $_user,
        ]);
        $this->assertCount(1, Integration::all());
    }

    /** @test */
    public function an_integration_can_be_updated_via_api() {
        $integration = Integration::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
                         ->putJson(route('api.integration.update', $integration->id), [
                             'marketplace' => Marketplace::Trendyol->value,
                             'username'    => fake()->userName(),
                             'password'    => fake()->password(),
                         ]);

        $response->assertStatus(200);
        $response->assertJson([
            'id'          => $integration->id,
            'marketplace' => Marketplace::Trendyol->value
        ]);
    }

    /** @test */
    public function an_integration_can_be_deleted_via_api() {
        $integration = Integration::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
                         ->deleteJson(route('api.integration.destroy', $integration->id));

        $response->assertStatus(204); // No Content
        $this->assertCount(0, Integration::all());
    }


}

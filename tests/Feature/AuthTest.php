<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase {


    /** @test */
    public function register_fails_with_invalid_email()
    {
        $response = $this->postJson(route('api.login'), [
            'email' => 'not-an-email',
            'password' => 'password123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function register_fails_when_required_field_is_missing()
    {
        $response = $this->postJson(route('api.login'), [
            'email' => 'user@example.com',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
    }

}

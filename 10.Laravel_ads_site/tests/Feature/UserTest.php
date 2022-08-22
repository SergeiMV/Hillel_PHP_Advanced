<?php

namespace Tests\Feature;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user()
    {
        $this->assertGuest($guard = null);

        $user = \App\Models\User::factory()->make();

        $attributes = [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'asdasdasd',
        ];
        $response = $this->post('/users/login', $attributes);
        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', ['username' => $user->username]);
        $this->assertAuthenticated();
    }

    public function test_created_user_wrong_password()
    {
        $user = \App\Models\User::factory()->make();

        $attributes = [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'asdasdasd',
        ];

        $response = $this->post('/users/login', $attributes);
        $this->assertAuthenticated();

        $response = $this->get('/users/logout');
        $response->assertRedirect('/');

        $attributes['password'] = 'qweqweqwe';

        $response = $this->post('/users/login', $attributes);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_empty_fields_login()
    {
        $user = \App\Models\User::factory()->make();

        $attributes = [
            'username' => $user->username,
            'email' => $user->email,
            'password' => null,
        ];

        $response = $this->post('/users/login', $attributes);
        $response->assertSessionHasErrors(['password']);

        $attributes = [
            'username' => null,
            'email' => $user->email,
            'password' => 'asdasdasda',
        ];

        $response = $this->post('/users/login', $attributes);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['username']);

        $attributes = [
            'username' => null,
            'email' => $user->email,
            'password' => null,
        ];

        $response = $this->post('/users/login', $attributes);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);

        $attributes = [
            'username' => 'asdasd',
            'email' => null,
            'password' => null,
        ];

        $response = $this->post('/users/login', $attributes);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password', 'email']);

        $attributes = [
            'username' => 'qweqwe',
            'email' => null,
            'password' => 'asdasd',
        ];

        $response = $this->post('/users/login', $attributes);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }
}

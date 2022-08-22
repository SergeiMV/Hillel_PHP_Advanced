<?php

namespace Tests\Feature;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_logout()
    {
        $response = $this->get('/users/logout');
        $response->assertStatus(403);
    }

    public function test_guest_login()
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

    public function test_guest_create_ad()
    {
        $this->assertGuest();
        $response = $this->post('/ads/create');
        $response->assertStatus(403);
    }

    public function test_guest_edit_ad()
    {
        $this->assertGuest();
        $response = $this->post('/ads/create');
        $response->assertStatus(403);

        $stranger = \App\Models\User::factory()->create();
        $stranger_ad = \App\Models\Ad::factory()->create([
            'author_id' => $stranger->id,
            'author_name' => $stranger->username
        ]);

        $response = $this->get("/ads/edit/$stranger_ad->id");
        $response->assertStatus(403);
    }

    public function test_guest_update_ad()
    {
        $this->assertGuest();
        $response = $this->post('/ads/create');
        $response->assertStatus(403);

        $stranger = \App\Models\User::factory()->create();
        $stranger_ad = \App\Models\Ad::factory()->create([
            'author_id' => $stranger->id,
            'author_name' => $stranger->username
        ]);

        $response = $this->put("/ads/$stranger_ad->id");
        $response->assertStatus(403);
    }

    public function test_guest_delete_ad()
    {
        $this->assertGuest();
        $response = $this->post('/ads/create');
        $response->assertStatus(403);

        $stranger = \App\Models\User::factory()->create();
        $stranger_ad = \App\Models\Ad::factory()->create([
            'author_id' => $stranger->id,
            'author_name' => $stranger->username
        ]);

        $response = $this->delete("/ads/$stranger_ad->id");
        $response->assertStatus(403);
    }

    public function test_auth_logout()
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
        $this->assertGuest();
    }

    public function test_auth_login()
    {
        $user = \App\Models\User::factory()->make();

        $attributes = [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'asdasdasd',
        ];

        $response = $this->post('/users/login', $attributes);
        $response->assertRedirect('/');

        $response = $this->post('/users/login', $attributes);
        $response->assertStatus(302);
    }

    public function test_auth_edit_stranger_ad()
    {
        $username = \App\Models\User::factory()->make();
        $stranger = \App\Models\User::factory()->create();

        $attributes = [
            'username' => $username->username,
            'email' => $username->email,
            'password' => 'asdasdasd',
        ];

        $response = $this->post('/users/login', $attributes);
        $this->assertAuthenticated();

        $user = \Illuminate\Support\Facades\Auth::user();
        $user_ad = \App\Models\Ad::factory()->create([
            'author_id' => $user->id,
            'author_name' => $user->username
        ]);

        $stranger_ad = \App\Models\Ad::factory()->create([
            'author_id' => $stranger->id,
            'author_name' => $stranger->username
        ]);

        $response = $this->get("/ads/edit/$user_ad->id");
        $response->assertStatus(200);

        $response = $this->get("/ads/edit/$stranger_ad->id");
        $response->assertStatus(403);
    }

    public function test_auth_update_stranger_ad()
    {
        $username = \App\Models\User::factory()->make();
        $stranger = \App\Models\User::factory()->create();

        $attributes = [
            'username' => $username->username,
            'email' => $username->email,
            'password' => 'qweewq',
        ];

        $response = $this->post('/users/login', $attributes);
        $this->assertAuthenticated();

        $user = \Illuminate\Support\Facades\Auth::user();
        $stranger_ad = \App\Models\Ad::factory()->create([
            'author_id' => $stranger->id,
            'author_name' => $stranger->username
        ]);

        $response = $this->put("/ads/$stranger_ad->id");
        $response->assertStatus(403);
    }

    public function test_auth_delete_stranger_ad()
    {
        $username = \App\Models\User::factory()->make();
        $stranger = \App\Models\User::factory()->create();

        $attributes = [
            'username' => $username->username,
            'email' => $username->email,
            'password' => 'qweewq',
        ];

        $response = $this->post('/users/login', $attributes);
        $this->assertAuthenticated();

        $user = \Illuminate\Support\Facades\Auth::user();
        $stranger_ad = \App\Models\Ad::factory()->create([
            'author_id' => $stranger->id,
            'author_name' => $stranger->username
        ]);

        $response = $this->delete("/ads/$stranger_ad->id");
        $response->assertStatus(403);
    }
}

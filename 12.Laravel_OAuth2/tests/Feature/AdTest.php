<?php

namespace Tests\Feature;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdTest extends TestCase
{
    use RefreshDatabase;

    public function test_ads_index()
    {
        $user = \App\Models\User::factory()->create();
        $user->each(function (User $user) {
            $ad = Ad::factory()->create(['author_name' => $user->username, 'author_id' => $user->id]);
        });
        $ad = Ad::firstWhere('id', 1);
        $response = $this->get('/');
        $response->assertSee($ad->title);
    }

    public function test_create_ad()
    {
        $user = \App\Models\User::factory()->make();

        $user_attributes = [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'password',
        ];

        $ad_attributes = [
            'title' => 'asdasd',
            'description' => 'asdasasdd',
        ];

        $response = $this->post('/users/login', $user_attributes);
        $this->assertAuthenticated();

        $user = \Illuminate\Support\Facades\Auth::user();

        $response = $this->post("/ads/create", $ad_attributes);
        $this->assertDatabaseHas(
            'ads',
            ['title' => $ad_attributes['title'], 'description' => $ad_attributes['description']]
        );
    }

    public function test_show_ad()
    {
        $user = \App\Models\User::factory()->create();
        $ad = \App\Models\Ad::factory()->create(['author_id' => $user->id, 'author_name' => $user->username]);
        $response = $this->get('/');
        $response->assertSeeText([$ad->title, $ad->description]);
    }

    public function test_edit_ad()
    {
        $user = \App\Models\User::factory()->make();

        $user_attributes = [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'password',
        ];

        $ad_attributes = [
            'title' => 'asdasd',
            'description' => 'asdasasdd',
        ];

        $response = $this->post('/users/login', $user_attributes);
        $this->assertAuthenticated();

        $user = \Illuminate\Support\Facades\Auth::user();

        $response = $this->post("/ads/create", $ad_attributes);
        $this->assertDatabaseHas(
            'ads',
            ['title' => $ad_attributes['title'], 'description' => $ad_attributes['description']]
        );

        $ad = Ad::firstWhere('title', $ad_attributes['title']);
        $response = $this->get('/ads/edit/' . $ad->id);
        $response->assertStatus(200);
    }

    public function test_update_ad()
    {
        $user = \App\Models\User::factory()->make();

        $user_attributes = [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'password',
        ];

        $ad_attributes = [
            'title' => 'asdasd',
            'description' => 'asdasasdd',
        ];

        $response = $this->post('/users/login', $user_attributes);

        $this->assertAuthenticated();

        $user = \Illuminate\Support\Facades\Auth::user();
        $response = $this->post("/ads/create", $ad_attributes);
        $this->assertDatabaseHas(
            'ads',
            [ 'title' => $ad_attributes['title'], 'description' => $ad_attributes['description']]
        );

        $ad = Ad::firstWhere('title', $ad_attributes['title']);
        $response = $this->put(
            '/ads/' . $ad->id,
            ['id' => $ad->id, 'title' => $ad_attributes['title'], 'description' => 'asdasd']
        );
        $response->assertRedirect('/ads/' . $ad->id);
    }

    public function test_delete_ad()
    {
        $user = \App\Models\User::factory()->make();

        $user_attributes = [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'password',
        ];

        $ad_attributes = [
            'title' => 'asdasd',
            'description' => 'asdasasdd',
        ];

        $response = $this->post('/users/login', $user_attributes);

        $this->assertAuthenticated();

        $user = \Illuminate\Support\Facades\Auth::user();
        $response = $this->post("/ads/create", $ad_attributes);
        $response = $this->post("/ads/create", $ad_attributes);
        $this->assertDatabaseHas(
            'ads',
            ['title' => $ad_attributes['title'], 'description' => $ad_attributes['description']]
        );

        $ad = Ad::firstWhere('title', $ad_attributes['title']);
        $response = $this->delete('/ads/' . $ad->id);
        $response->assertRedirect('/');
        $this->assertDatabaseMissing('ads', ['id' => $ad->id]);
    }

    public function test_ads_pagination()
    {
        $user = \App\Models\User::factory()->create();
        $ads = \App\Models\Ad::factory(5)->create(['author_id' => $user->id, 'author_name' => $user->username]);
        $ads->each(function (Ad $ad) {
            $response = $this->get('/');
            $response->assertSeeText([$ad->title, $ad->description]);
        });

        $ad_2 = \App\Models\Ad::factory(5)->create(['author_id' => $user->id, 'author_name' => $user->username]);
        $ad_2->each(function (Ad $ad) {
            $response = $this->get('/');
            $response->assertDontSeeText([$ad->title, $ad->description]);
            $response = $this->get('/?page=2');
            $response->assertSeeText([$ad->title, $ad->description]);
        });
    }

    public function test_ads_owners_buttons_on_home()
    {
        $user_attributes = [
            'username' => 'user',
            'email' => 'email@mail.com',
            'password' => 'password',
        ];

        $ad_attributes = [
            'title' => 'asdasd',
            'description' => 'asdasasdd',
        ];

        $this->post('/users/login', $user_attributes);

        $this->assertAuthenticated();

        $user = \App\Models\User::firstWhere('username', $user_attributes['username']);
        $ads = Ad::factory()->create(['author_id' => $user->id, 'author_name' => $user->username]);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeText(['Edit', 'Delete']);
    }

    public function test_ads_owners_buttons_on_show()
    {
        $user_attributes = [
            'username' => 'user',
            'email' => 'email@mail.com',
            'password' => 'password',
        ];

        $ad_attributes = [
            'title' => 'asdasd',
            'description' => 'asdasasdd',
        ];

        $this->post('/users/login', $user_attributes);

        $this->assertAuthenticated();

        $user = \App\Models\User::firstWhere('username', $user_attributes['username']);
        $ad = Ad::factory()->create(['author_id' => $user->id, 'author_name' => $user->username]);
        $response = $this->get('/ads/' . $ad->id);
        $response->assertStatus(200);
        $response->assertSeeText(['Edit', 'Delete']);

        $user_2 = User::factory()->create();
        $ad_2 = Ad::factory()->create(['author_id' => $user_2->id, 'author_name' => $user_2->username]);
        $response = $this->get('/ads/' . $ad_2->id);
        $response->assertStatus(200);
        $response->assertDontSeeText(['Edit', 'Delete']);
    }
}

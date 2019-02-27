<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Mockery as m;

use App\User;

use Revolution\Google\Photos\Facades\Photos;

class PhotosTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        m::close();
    }

    public function testAlbums()
    {
        Photos::shouldReceive('setAccessToken')->once()->andReturn(m::self());
        Photos::shouldReceive('listAlbums')->once()->andReturn((object)['albums' => []]);

        $user = factory(User::class)->make();

        $response = $this->actingAs($user)
                         ->get('/albums');

        $response->assertStatus(200)
                 ->assertViewHas('albums');
    }

    public function testMediaItems()
    {
        Photos::shouldReceive('setAccessToken')->once()->andReturn(m::self());
        Photos::shouldReceive('search')->once()->andReturn((object)['mediaItems' => []]);

        $user = factory(User::class)->make();

        $response = $this->actingAs($user)
                         ->get('/mediaitems');

        $response->assertStatus(200)
                 ->assertViewHas('mediaitems');
    }
}

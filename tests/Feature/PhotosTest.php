<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Mockery as m;

use App\User;

use PulkitJalan\Google\Facades\Google;
use Revolution\Google\Photos\Photos;
use Revolution\Google\Photos\PhotosInterface;

class PhotosTest extends TestCase
{
    /**
     * @var Photos
     */
    protected $photos;

    public function setUp()
    {
        parent::setUp();

        $this->photos = m::mock(Photos::class);
        app()->instance(PhotosInterface::class, $this->photos);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testAlbums()
    {
        Google::shouldReceive('setAccessToken')->once();
        Google::shouldReceive('isAccessTokenExpired')->once()->andReturn(false);
        Google::shouldReceive('make')->once();
        $this->photos->shouldReceive('setService')->once()->andReturn($this->photos);
        $this->photos->shouldReceive('listAlbums')->once()->andReturn((object)['albums' => []]);

        $user = factory(User::class)->make();

        $response = $this->actingAs($user)
                         ->get('/albums');

        $response->assertStatus(200)
                 ->assertViewHas('albums');
    }

    public function testMediaItems()
    {
        Google::shouldReceive('setAccessToken')->once();
        Google::shouldReceive('isAccessTokenExpired')->once()->andReturn(false);
        Google::shouldReceive('make')->once();
        $this->photos->shouldReceive('setService')->once()->andReturn($this->photos);
        $this->photos->shouldReceive('search')->once()->andReturn((object)['mediaItems' => []]);

        $user = factory(User::class)->make();

        $response = $this->actingAs($user)
                         ->get('/mediaitems');

        $response->assertStatus(200)
                 ->assertViewHas('mediaitems');
    }
}

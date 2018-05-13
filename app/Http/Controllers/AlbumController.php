<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PulkitJalan\Google\Facades\Google;

use Revolution\Google\Photos\Facades\Photos;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        //        $token = $request->user()->access_token;
        //
        //        Google::setAccessToken($token);
        //
        //        $photos = Google::make('PhotosLibrary');

        $optParams = ['pageSize' => 10];

        // Google's Client Library
        //        $albums_object = $photos->albums->listAlbums($optParams)->toSimpleObject();

        // Facade
        //        $albums_object = Photos::setService($photos)->listAlbums($optParams);

        // PhotosLibrary Trait
        $albums_object = $request->user()->photos()->listAlbums($optParams);

        //        dd($albums_object);

        $albums = $albums_object->albums ?? [];
        $nextPageToken = $albums_object->nextPageToken ?? null;

        //                dd($albums);

        return view('albums')->with(compact('albums'));
    }

    /**
     * @param Request $request
     * @param         $id
     */
    public function show(Request $request, $id)
    {
        $album = $request->user()->photos()->album($id);
        dd($album);
    }
}

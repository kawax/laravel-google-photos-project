<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Revolution\Google\Photos\Facades\Photos;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $optParams = [];

        //        $mediatypefilter = new \Google_Service_PhotosLibrary_MediaTypeFilter();
        //        $mediatypefilter->setMediaTypes('ALL_MEDIA');
        //
        //        $filters = new \Google_Service_PhotosLibrary_Filters();
        //
        //        $filters->setMediaTypeFilter($mediatypefilter);
        //
        //        $optParams = ['pageSize' => 100, 'filters' => $filters];


        // Facade
        $user = $request->user();

        $token = [
            'access_token'  => $user->access_token,
            'refresh_token' => $user->refresh_token,
            'expires_in'    => $user->expires_in,
            'created'       => $user->updated_at->getTimestamp(),
        ];

        $media_object = Photos::setAccessToken($token)->search($optParams);


        // Trait
        //        $media_object = $request->user()->photos()->search($optParams);

        //        dd($media_object);

        $mediaitems = $media_object->mediaItems ?? [];

        //        $nextPageToken = $media_object->nextPageToken ?? null;

        return view('mediaitems')->with(compact('mediaitems'));
    }

    /**
     * @param Request $request
     * @param         $id
     */
    public function show(Request $request, $id)
    {
        $media = $request->user()->photos()->media($id);

        dd($media);
    }

    /**
     * @param Request $request
     * @param         $id
     */
    public function album(Request $request, $id)
    {
        $optParams = ['albumId' => $id];

        $media_object = $request->user()->photos()->search($optParams);

        dd($media_object);
    }
}

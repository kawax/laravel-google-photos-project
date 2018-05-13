<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!$request->hasFile('file')) {
            return redirect('home');
        }

        $photos = $request->user()->photos();

        $file = $request->file('file');

        $uploadToken = $photos->upload(
            $file->getClientOriginalName(),
            fopen($file->getRealPath(), 'r')
        );

        $result = $photos->batchCreate([$uploadToken]);

        //        dd($result);

        return redirect('home')->with('status', 'Upload success');
    }
}

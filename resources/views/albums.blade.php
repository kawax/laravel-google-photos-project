@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">albums</div>

                    <div class="card-body">
                        @foreach($albums as $album)
                            <ul>
                                <li>id :
                                    <a href="{{ route('albums.show', $album->id) }}">{{ str_limit($album->id, 10) }}</a>
                                </li>
                                <li>title :
                                    <a href="{{ route('mediaitems.album', $album->id) }}">{{ str_limit($album->title, 10) }}</a>
                                </li>
                                <li>totalMediaItems : {{ $album->totalMediaItems }}</li>
                                <li>coverPhotoBaseUrl : {{ str_limit($album->coverPhotoBaseUrl, 30) }}</li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

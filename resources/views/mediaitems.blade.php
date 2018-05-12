@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">mediaItems</div>

                    <div class="card-body">
                        @foreach($mediaitems as $mediaitem)
                            <ul>
                                <li>id :
                                    <a href="{{ route('mediaitems.show', $mediaitem->id) }}">{{ str_limit($mediaitem->id, 10) }}</a>
                                </li>
                                <li>description : {{ str_limit($mediaitem->description ?? '', 10) }}</li>
                                <li>mimeType : {{ $mediaitem->mimeType ?? '' }}</li>
                                <li>baseUrl : {{ str_limit($mediaitem->baseUrl, 30) }}</li>
                                <li>mediaMetadata.creationTime
                                    : {{ $mediaitem->mediaMetadata->creationTime ?? '' }}
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul>
                            <li>
                                <a href="{{ route('albums.index') }}">albums</a>
                            </li>
                            <li>
                                <a href="{{ route('mediaitems.index') }}">mediaitems</a>
                            </li>
                            <li>
                                <a href="{{ route('form') }}">upload</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

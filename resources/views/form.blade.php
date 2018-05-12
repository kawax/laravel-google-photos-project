@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload</div>

                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('upload') }}" method="post">
                            @csrf
                            <div class="form-group">

                                <div class="custom-file">
                                    <input name="file" type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>

                            </div>

                            <input type="submit" value="Upload" class="btn btn-primary">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

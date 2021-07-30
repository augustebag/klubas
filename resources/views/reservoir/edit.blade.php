@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit</div>
                <div class="card-body">
                    <form method="POST" action="{{route('reservoir.update',$reservoir)}}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" class="form-control" name="reservoir_title"
                                value="{{old('reservoir_name', $reservoir->title)}}">
                            <small class="form-text text-muted">Title.</small>
                        </div>
                        <div class="form-group">
                            <label>Area:</label>
                            <input type="text" class="form-control" name="reservoir_area"
                                value="{{old('reservoir_area', $reservoir->area)}}">
                            <small class="form-text text-muted">Runs.</small>
                        </div>
                        <div class="form-group">
                            <div class="small-photo">
                                @if($reservoir->photo)
                                <img src="{{$reservoir->photo}}">
                                <label>Delete photo <input type="checkbox" name="delete_reservoir_photo"></label>
                                @else
                                <img src="{{asset('no-img.png')}}">
                                @endif
                            </div>
                            <label>Photo</label>
                            <input type="file" class="form-control" name="reservoir_photo">
                            <small class="form-text text-muted">Upload photo</small>
                        </div>
                        <div class="form-group">
                            <label>About:</label>
                            <textarea type="text" class="form-control" name="reservoir_about"
                                value="{{old('reservoir_about', $reservoir->about)}}" id="summernote"></textarea>
                            <small class="form-text text-muted">About.</small>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-outline-dark btn-sm">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
       $('#summernote').summernote();
     });
</script>

@endsection
@section('title') Reservoir @endsection
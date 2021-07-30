@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Reservoir</div>
                <div class="card-body">
                    <form method="POST" action="{{route('reservoir.store')}}" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Tile:</label>
                            <input type="text" class="form-control" name="reservoir_title" value="{{old('reservoir_title')}}">
                            <small class="form-text text-muted">Title.</small>
                        </div>

                        <div class="form-group">
                            <label>Area:</label>
                            <input type="text" class="form-control" name="reservoir_area" value="{{old('reservoir_area')}}">
                            <small class="form-text text-muted">Area.</small>
                        </div>

                        <div class="form-group">
                            <label>About:</label>
                            <textarea type="text" class="form-control" name="reservoir_about" id="summernote"
                                value="{{old('reservoir_about')}}"></textarea>
                            <small class="form-text text-muted">About.</small>
                        </div>

                        <div class="form-group">
                            <label>Photo</label>
                            <input type="file" class="form-control" name="reservoir_photo">
                            <small class="form-text text-muted">Upload photo</small>
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-outline-dark btn-sm">ADD</button>

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
@section('title') Reservoirs @endsection
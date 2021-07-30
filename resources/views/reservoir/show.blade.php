@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{$reservoir->title}}</div>
        <div class="card-body">
          <div class="form-group list-container__photo">
            <label>Photo</label>@if($reservoir->photo)
            <img src="{{$reservoir->photo}}">
            @else
            <img src="{{asset('no-img.png')}}">
            @endif
          </div>
          <div class="form-group">
            <label>Title</label>
            <small class="form-text text-muted">{{$reservoir->title}}</small>
          </div>
          <div class="form-group">
            <label>Area</label>
            <small class="form-text text-muted"> {{$reservoir->area}}</small>
          </div>
          <div class="form-group">
            <label>About</label>
            <small class="form-text text-muted"> {{$reservoir->about}}></small>
          </div>
          <a href="{{route('reservoir.edit',[$reservoir])}}" class="btn btn-outline-dark btn-sm">Edit</a>
          <a href="{{route('reservoir.pdf',[$reservoir])}}" class="btn btn-outline-dark btn-sm">PDF</a>
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
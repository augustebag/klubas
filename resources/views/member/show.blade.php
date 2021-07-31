@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{$member->reservoirOfMember->title}}</div>
        <div class="card-body">
          <div class="form-group">
            <label>Member Name</label>
            <small class="form-text text-muted">{{$member->name}}</small>
          </div>
          <div class="form-group">
            <label>Member Surname</label>
            <small class="form-text text-muted">{{$member->surname}}</small>
          </div>
          <div class="form-group">
            <label> Live</label>
            <small class="form-text text-muted"> {{$member->live}}</small>
          </div>
          <div class="form-group">
            <label> About</label>
            <small class="form-text text-muted"> {{$member->about}}</small>
          </div>
          <a href="{{route('member.edit',[$member])}}" class="btn btn-outline-dark btn-sm">Edit</a>
          <a href="{{route('member.pdf',[$member])}}" class="btn btn-outline-dark btn-sm">PDF</a>
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

@section('title') Member @endsection
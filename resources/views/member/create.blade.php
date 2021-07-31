@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">New Member</div>

        <div class="card-body">
          <form method="POST" action="{{route('member.store')}}">
            <div class="form-group">
              <label>Name:</label>
              <input type="text" class="form-control" name="member_name" value="{{old('member_name')}}">
              <small class="form-text text-muted">Name.</small>
            </div>

            <div class="form-group">
              <label>Surname:</label>
              <input type="text" class="form-control" name="member_surname" value="{{old('member_surname')}}">
              <small class="form-text text-muted">Surname.</small>
            </div>

            <div class="form-group">
              <label>Live:</label>
              <input type="text" class="form-control" name="member_live" value="{{old('member_live')}}">
              <small class="form-text text-muted">Live.</small>
            </div>

              <div class="form-group">
                <label>Experience:</label>
                <input type="text" class="form-control" name="member_experience" value="{{old('member_experience')}}">
                <small class="form-text text-muted">Experience.</small>
              </div>
              <div class="form-group">
                <label>Registered:</label>
                <input type="text" class="form-control" name="member_registered" value="{{old('member_registered')}}">
                <small class="form-text text-muted">Registered.</small>
              </div>
              <div class="form-group">
                <label>About:</label>
                <textarea type="text" class="form-control" name="member_about" id="summernote" value="{{old('member_about')}}"></textarea>
                <small class="form-text text-muted">About.</small>
              </div>

            <select name="reservoir_id">
              @foreach ($reservoirs as $reservoir)
              <option value="{{$reservoir->id}}">{{$reservoir->title}}</option>
              @endforeach
            </select>
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
@section('title') Members @endsection
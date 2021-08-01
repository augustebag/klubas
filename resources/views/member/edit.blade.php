@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Edit</div>

        <div class="card-body">
          <form method="POST" action="{{route('member.update',[$member])}}">
            <div class="form-group">
              <label>Name:</label>
              <input type="text" class="form-control" name="member_name" value="{{old('member_name', $member->name)}}">
              <small class="form-text text-muted">Name.</small>
            </div>

            <div class="form-group">
              <label>Surname:</label>
              <input type="text" class="form-control" name="member_surname"
                value="{{old('member_surname', $member->surname)}}">
              <small class="form-text text-muted">Surname.</small>
            </div>

            <div class="form-group">
              <label>Live:</label>
              <input type="text" class="form-control" name="member_live" value="{{old('member_live', $member->live)}}">
              <small class="form-text text-muted">Live.</small>
            </div>

            <div class="form-group">
                <label>Experience:</label>
                <input type="text" class="form-control" name="member_experience" value="{{old('member_experience', $member->experience)}}">
                <small class="form-text text-muted">Experience.</small>
              </div>

              <div class="form-group">
                <label>Registered:</label>
                <input type="text" class="form-control" name="member_registered" value="{{old('member_registered', $member->registered)}}">
                <small class="form-text text-muted">Registered.</small>
              </div>
  

            <select name="reservoir_id">
              @foreach ($reservoirs as $reservoir)
              <option value="{{$reservoir->id}}">{{$reservoir->title}}</option>
                {{$reservoir->name}} {{$reservoir->surname}}
              </option>
              @endforeach
            </select>
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
@section('title') Members @endsection
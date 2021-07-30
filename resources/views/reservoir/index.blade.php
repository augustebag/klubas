@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h2>Reservoir</h2>
          <div class="row">
            <form action="{{route('reservoir.index')}}" method="get" class="sort-form">
              <fieldset>
                <legend>Sort by: </legend>
                <div>
                  <label>Title </label>
                  <input type="radio" name="sort_by" value="title" @if('title'==$sort) checked @endif>
                  <label>Area </label>
                  <input type="radio" name="sort_by" value="area" @if('area'==$sort) checked @endif>
                </div>
              </fieldset>
              <button type="submit" class="btn btn-sm btn-outline-dark">Sort</button>
              <a href="{{route('reservoir.index')}}" class="btn btn-outline-danger btn-sm">Clear</a>
            </form>
            <form action="{{route('reservoir.index')}}" method="get" class="sort-form">
              <fieldset>
                <legend>Search: </legend>
                <div class="form-group">
                  <input type="search" class="form-control mr-sm-2 search" placeholder="Search" aria-label="Search"
                    name="s">
                  <button class="btn btn-sm btn-outline-dark" type="submit">Search</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
      <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th scope="col">Photo</th>
            <th scope="col">Title</th>
            <th scope="col">Area</th>
            <th scope="col">About</th>
            <th scope="col">*</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($reservoirs as $reservoir)
          <tr>
            <td class="list-container__photo" {{$reservoir->photo}}>
              @if($reservoir->photo)
              <img src="{{$reservoir->photo}}">
              @else
              <img src="{{asset('no-img.png')}}">
              @endif
            </td>
            <td>{{$reservoir->title}}</td>
            <td>{{$reservoir->area}}</td>
            <td>{{$reservoir->about}}</td>
            <td class="list-container__buttons">
              <form method="POST" action="{{route('reservoir.destroy', [$reservoir])}}">
                @csrf
                <a href="{{route('reservoir.show',[$reservoir])}}" class="btn btn-outline-success btn-sm">More info</a>
                <a href="{{route('reservoir.edit',[$reservoir])}}" class="btn btn-outline-success btn-sm">Edit</a>
                <button type="submit" class="btn btn-outline-danger btn-sm">DELETE</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$reservoirs->links()}}
    </div>
  </div>
</div>
@endsection
@section('title') Reservoir @endsection
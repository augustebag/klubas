@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h2>Members</h2>
          <div class="row">
            <form action="{{route('member.index')}}" method="get">
              <fieldset>
                <legend>Sort by: </legend>
                <div>
                  <label>Name </label>
                  <input type="radio" name="sort_by" value="name" @if('name'==$sort) checked @endif>

                  <label>Surname </label>
                  <input type="radio" name="sort_by" value="surname" @if('surname'==$sort) checked @endif>
                </div>
              </fieldset>
              <button type="submit" class="btn btn-sm btn-outline-dark">Sort</button>
              <a href="{{route('member.index')}}" class="btn btn-outline-danger btn-sm">Clear</a>
            </form>
            <form action="{{route('member.index')}}" method="get" class="sort-form">
              <fieldset>
                <legend>Filter by: </legend>
                <select class="reservoir_id" class="form-control">
                  @foreach($reservoirs as $reservoir)
                  <option value="{{$reservoir->id}}" @if($defaultReservoir == $reservoir->id) selected @endif>
                    {{$reservoir->name}}
                  </option>
                  @endforeach
                </select><br>
              </fieldset>
                <button type="submit" class="btn btn-sm btn-outline-dark filter">Submit</button>
            </form>
            <form action="{{route('member.index')}}" method="get" class="sort-form">
              <fieldset>
                <legend>Search: </legend>
                <input type="search" class="form-control mr-sm-2 search" placeholder="Search" aria-label="Search"
                  name="s">
                <button class="btn btn-sm btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                <a href="{{route('member.index')}}" class="btn btn-sm btn-outline-danger my-2 my-sm-0">Clear</a>
              </fieldset>
            </form>
          </div>
        </div>
      </div>


      <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Live</th>
            <th scope="col">Experience</th>
            <th scope="col">Registered</th>
            <th scope="col">Title</th>
            <th scope="col">*</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($members as $member)
          <tr>
            <td>{{$member->name}}</td>
            <td>{{$member->surname}}</td>
            <td>{{$member->live}}</td>
            <td>{{$member->experience}}</td>
            <td>{{$member->registered}}</td>
            <td>{{$member->memberReservoir->title}}</td>
            <td class="list-container__buttons">
              <form method="POST" action="{{route('member.destroy', [$member])}}">
                @csrf
                <a href="{{route('member.show',[$member])}}" class="btn btn-outline-success btn-sm">More info</a>
                <a href="{{route('member.edit',[$member])}}" class="btn btn-outline-success btn-sm">Edit</a>
                <button type="submit" class="btn btn-outline-danger btn-sm">DELETE</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$members->links()}}
    </div>
  </div>
</div>
@endsection
@section('title') Members @endsection
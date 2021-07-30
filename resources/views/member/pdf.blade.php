<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PDF</title>
</head>

<body>
  <h1> Reservoir: {{$member->memberReservoir->title}} </h1>
  <div class="form-group">
    <small class="form-text text-muted"> Name: {{$member->title}}</small>
  </div>
  <div class="form-group">
    <label>Name: </label>
    <small class="form-text text-muted"> {{$member->name}}</small>
  </div>
  <div class="form-group">
    <label> Surname: </label>
    <small class="form-text text-muted"> {{$member->surname}}</small>
  </div>
  <div class="form-group">
    <label> Live: </label>
    <small class="form-text text-muted"> {{$member->live}}</small>
  </div>
  <div class="form-group">
    <label> About: </label>
    <small class="form-text text-muted"> {{$member->about}}</small>
  </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PDF</title>
</head>

<body>
  <h1> Title: {{$reservoir->title}} </h1>
  <div class="form-group">
  </div>
  <div class="form-group">
    <label>Area: </label>
    <small class="form-text text-muted"> {{$reservoir->area}}</small>
  </div>
  <div class="form-group">
    <label> About: </label>
    <small class="form-text text-muted"> {{$reservoir->about}}</small>
  </div>
</body>

</html>
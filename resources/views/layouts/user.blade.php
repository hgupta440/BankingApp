<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Banking App</title>
    @include('layouts.partials.css')
</head>
<body>   
  <div class="page">
    @include('layouts.partials.navbar')
    <div class="container-xl">             

      <div class="row justify-content-center mt-5">
        <div class="col-md-8">
              @yield('content')
        </div>
      </div>
    </div>
  </div>
  @include('layouts.partials.js')

</body>
</html>
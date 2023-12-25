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


    <div class="container">
        <div class="page page-center">
            <div class="container container-narrow py-4">
                <div class="text-center mb-4">
                  <h1>ABC BANK</h1>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.partials.js')

</body>
</html>
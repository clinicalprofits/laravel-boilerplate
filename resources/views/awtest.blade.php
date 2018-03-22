<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="@yield('body_class')">
   <h1>Hello World!</h1>
   
   @foreach($items as $item)
   <li>{{ $campaign->Name }}</li>
   @endforeach

</body>
</html>

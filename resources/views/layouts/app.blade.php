<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="{{asset('img/dishub.png')}}" type="image/x-icon">
  <title>@yield('title')</title>

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('build/assets/app-zGp6DZHc.css') }}">
  <script src="{{ asset('build/assets/app-ecWDpuvf.js') }}"></script>

  {{-- @vite('resources/css/app.css') --}}
</head>
<body>
  
  @yield('content')
  
  <script src="{{asset('js/dropdown.js')}}"></script>
  <script src="{{asset('js/jadwal-switch.js')}}"></script>
  <script src="{{asset('js/navbar.js')}}"></script>

  {{-- aos --}}
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
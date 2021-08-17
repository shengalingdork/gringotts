<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/yeti/bootstrap.min.css"
      integrity="sha384-mLBxp+1RMvmQmXOjBzRjqqr0dP9VHU2tb3FK6VB0fJN/AOu7/y+CAeYeWJZ4b3ii"
      crossorigin="anonymous"
    >
    <link href="{{ asset('fonts/css/open-iconic-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/css/font-awesome.css') }}" rel="stylesheet"> 
    <title>{{ config('app.name', 'Gringotts') }}</title>
  </head>
  <body class="antialiased">
    <div id="app" style="overflow-x: hidden;">
      @include('layouts.elements.header')
      <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
          @yield('content')
        </div>
      </div>
      @include('layouts.elements.footer')
    </div>
    <!-- <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script> -->
    <!-- <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"
    ></script>
    <script src="{{ asset('js/utility.js') }}"></script>
    <script src="{{ asset('js/lookups.js') }}"></script>
    <script src="{{ asset('js/schemes.js') }}"></script>
    <script src="{{ asset('js/records.js') }}"></script>
    <script src="{{ asset('js/loans.js') }}"></script>
    <!-- <script src="{{ asset('js/charts.js') }}"></script> -->
  </body>
</html>

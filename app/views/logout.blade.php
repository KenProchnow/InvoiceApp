@extends('templates/main')
@section('content') 

<style>
ul,li{
  text-decoration: none;
  list-style-type: none;
  /*font-size: 16px;*/
}
</style> 

{{-- <script src="js/bootstrap.js" ></script> --}}
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js') }}
<script src=" {{asset('js/bootstrap.js')}} " ></script>

{{-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css">  --}}
<link rel="stylesheet" type="text/css" href=" {{ asset('css/bootstrap.css') }} "> 
<link rel="stylesheet" type="text/css" href=" {{ asset('css/styles.css') }} "> 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">


<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laravel PHP Framework</title>
  
</head>

<div class="container">

<div class="col-sm-2">

</div>

<div class="col-sm-10">
<h2>You are logged Out</h2>
<a href="{{ url('login') }}" >Log In</a>


<br>
</div>

{{-- {{ link_to_route('/login','Log in')}} --}}





</div> {{-- end container --}}




 {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.2/highcharts.js') }}
  {{ HTML::script('js/app.js') }}
</html>


@stop
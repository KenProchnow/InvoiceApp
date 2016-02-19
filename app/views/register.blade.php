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







{{ Form::open( array('url' => 'register','class' => 'form-horizontal') )}}

<div class="col-sm-2">

</div>

<div class="col-sm-10">
<h2>Register page</h2>
<br>
</div>

  <div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Email: </label>
    <div class="col-sm-6">
      {{ Form::text('email','',array('class' => 'form-control', 'placeholder' => 'email')) }}
    </div>
  </div>

<div class="form-group">
    <label for="inputUserName" class="col-sm-2 control-label">User Name: </label>
    <div class="col-sm-6">
{{ Form::text('username','',array('class' => 'form-control', 'placeholder' => 'username') ) }}
  </div>
</div>


<div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Password: </label>
    <div class="col-sm-6">
      <input type="password" name="password" class ="form-control" placeholder = "password">
{{-- {{ Form::password('password','',array('class' => 'form-control', 'placeholder' => 'name') ) }} --}}
  </div>
</div>



  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {{ Form::submit('Create',array('class'=>'btn btn-info')) }}  
    </div>
  </div>



{{ Form::close() }} 




</div> {{-- end container --}}




 {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.2/highcharts.js') }}
  {{ HTML::script('js/app.js') }}
</html>



@stop
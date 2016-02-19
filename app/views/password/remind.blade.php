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



<form action="{{ action('RemindersController@postRemind') }}" method="POST" class="form-horizontal">


<div class="col-sm-2">

</div>

<div class="col-sm-10">
<h2>Forgot Password Page</h2>
<br>
</div>

{{-- 
<form action="{{ action('RemindersController@postRemind') }}" method="POST">
    Enter your Email: <input type="email" name="email">
    <input type="submit" value="Send Reminder">
</form> 
--}}




  <div class="form-group">
    <label for="inputUserName" class="col-sm-2 control-label">Enter your Email: </label>
    <div class="col-sm-6">
      {{ Form::text('email','',array('class' => 'form-control', 'placeholder' => 'user email you singed up with') ) }}
    </div>
  </div>

<div class="clear"></div><br>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {{ Form::submit('Send reset Link',array('class'=>'btn btn-info')) }}  
    </div>
  </div>

</form>

</div> {{-- end container --}}




 {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.2/highcharts.js') }}
  {{ HTML::script('js/app.js') }}
</html>



@stop
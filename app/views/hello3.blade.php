
@extends('templates/main')

@section('content')
<h1>Hi</h1>
@stop

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	
</head>
<div class="container">

<body>
	<div class="welcome">

		<h1>This is Hello2.php template </h1>
		<h3>today's date: {{date('M d, Y')}}</h3>
		
		<p>name: {{$name}}</p>
		<p>lname: {{$lname}}</p>
		<p>phone: {{$phone}}</p>
		<p>phone: {{ URL::asset('/prac') }}</p>
		
	</div>
</body>
</div>

</html>

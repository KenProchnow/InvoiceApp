
@extends('templates/main')

@section('content')
	<h1>This is Hello2.php template </h1>
	<h3>today's date: {{date('M d, Y')}}</h3>

	{{-- <p>name: {{$name}}</p>
	<p>lname: {{$lname}}</p>
	<p>phone: {{$phone}}</p>
	<p>phone: {{ URL::asset('/prac') }}</p> --}}
	<p>name: {{{$data['name']}}}</p>
	<p>lname: {{{$data['lname']}}}</p>
	<p>phone: {{{$data['phone']}}}</p>
	<p>phone: {{{$data['malicious']}}}</p>
	<p>phone: {{ URL::asset('/prac') }}</p>

	@foreach ($data as $item)
		<li>{{{$item}}}</li>
	@endforeach

@stop


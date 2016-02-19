@extends('templates/main')
@section('content')	

<h2>Create a new To Do list</h2>
	{{ Form::open( array('route' => 'todos.store') )}}
		{{ $errors->first('name','<div class="alert alert-danger">:message</div>') }}
		{{ Form::label('name','List Title') }}
		{{ Form::text('name') }}
		{{ Form::submit('update',array('class'=>'btn btn-info')) }}
	{{ Form::close() }}	

@stop


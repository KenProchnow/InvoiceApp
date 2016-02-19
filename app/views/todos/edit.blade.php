@extends('templates/main')
@section('content')	

<h2>Create a new To Do list</h2>
	{{ Form::model($list, array('route'=> ['todos.update',$list->id], 'method'=>'PUT' ) )}}
		{{ $errors->first('name','<div class="alert alert-danger">:message</div>') }}
		{{ Form::label('name','List Title') }}
		{{ Form::text('name') }}
		{{ Form::submit('update',array('class'=>'btn btn-info')) }}
	{{ Form::close() }}	

@stop


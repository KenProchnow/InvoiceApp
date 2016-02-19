
@extends('templates/main')

@section('content')
	
	
	<h3>{{{ $list->name }}}</h3>
	
	<ul>
	@foreach ($items as $item)
		<li>{{{ $item->content }}}</li>
	@endforeach
	</ul>

	<p>{{ link_to_route('todos.index','<- Back')}}</p>
@stop


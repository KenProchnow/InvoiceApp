

@extends('templates/main')

@section('content')

	@if (Session::has('message'))
	<div class="alert alert-success">
  	<strong>Success!</strong> {{{ Session::get('message') }}}
	</div>
		
	@endif

	<h3>Show All To Do Lists:</h3>
	

	<ul>
		<table class="table table-striped">
		    <thead>
		      <tr>
		        <th>List Name</th>
		        <th>Action</th>
		        <th>Action</th>		        
		      </tr>
		    </thead>
			    <tbody>
					@foreach ($todo_lists as $list)
						</tr> 
							<td>{{ link_to_route('todos.show',$list->name, [$list->id] )  }} </td>
							<td>{{ link_to_route('todos.edit','edit',[$list->id], ['class'=>'btn btn-sm btn-default']) }}</td>
							<td>
								{{Form::model($list, ['route' => ['todos.destroy',$list->id], 'method'=>'delete' ] ) }}
									{{Form::button('destroy', ['type'=>'submit','class'=>'btn btn-sm btn-danger'])}}
								{{Form::close() }}
								
							</td>
						</tr>
					@endforeach		    
			    </tbody>
		  	</table>


		<br>{{ link_to_route('todos.create','+ Create New List',null,['class' =>'btn btn-success']) }}
		
	</ul>
	

@stop


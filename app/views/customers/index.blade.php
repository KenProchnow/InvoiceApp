@extends('templates/main')
@section('content')	

@if (Session::has('message'))
	@if ( Session::get('message_status') == 'failed' )
		<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>	
	  	<strong></strong> {{{ Session::get('message') }}}
		</div>
	@endif

	@if ( Session::get('message_status') == 'success' )
		<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>	
	  	<strong></strong> {{{ Session::get('message') }}}
		</div>
	@endif
	
		
@endif



<div class="col-sm-12 well">     
	<div class="col-sm-3">     
		<h4>Add Customers:</h4>
		<a> {{ link_to_route('customers.create','+ Create New or Mass Upload',null,['class' =>'btn btn-success btn-sm']) }} </a>   
	</div>	
	<div class="col-sm-9 ">
		<div class="col-sm-8">
		<h4>For all Checked Customers, Create and Send Invoice:</h4>
		<a href="{{ action("InvoiceController@massUpload") }}" onclick="return confirm('Are you sure you want to mass create and send invoices?')" class ="btn btn-primary btn-sm areyousure"><span class="glyphicon glyphicon-send"></span> Send Invoices</a>

		</div>

		<div class="col-sm-4">
		<h4>Download all customers:</h4>
		<a href="{{ action("CustomersController@export") }}"  class ="btn btn-primary btn-sm"><span class="glyphicon glyphicon-download-alt"></span> Download Customers</a>
		</div>
	</div>	

</div>

<div class="clear"></div>
<br>

{{-- {{ Form::open(array('url' => 'customers', 'class'=>'form-inline well')) }} --}}
<h5>Filters:</h5>	
{{ Form::model('Customer', array('route'=> ['customers.index'], 'method'=>'GET','class' => 'form-inline well' ) )}}
{{-- {{ Form::open( array('route' => 'customers.index','class' => 'form-inline well') )}} --}}

  <div class="form-group">
    <label for="exampleInputName2">Search Sid</label>
    <input type="text" name="sid" class="form-control" value="{{ $sid }}" id="exampleInputName2" placeholder="">
    &nbsp;&nbsp;
  </div>

  <div class="form-group">
    <label for="exampleInputEmail2">Search Name</label>
    <input type="text" name="name" class="form-control" value="{{ $name }}" id="exampleInputEmail2" placeholder="">
    &nbsp;&nbsp;
  </div>

  <div class="form-group">
    <label for="exampleInputEmail2">limit by $ amount great than:</label>
    <input type="text" name="prepay_amount" class="form-control" id="exampleInputEmail2" value="{{ $prepay_amount }}" placeholder="">
    
  </div>


  {{-- <div class="checkbox checkbox-primary">		
    <input id="111" type="checkbox">
    <label for="111"> check here</label>
    &nbsp;
    <input id="112" type="checkbox">
    <label for="112"> check here</label>
    &nbsp;
    <input id="113" type="checkbox">
    <label for="113"> check here</label>
    &nbsp;
    <input id="114" type="checkbox">
    <label for="114"> check here</label>
    &nbsp;
  </div>  --}}

	{{Form::button('submit', ['type'=>'submit','class'=>'btn btn-sm btn-default'])}}

{{ Form::close() }} 

<h2>Customers:</h2>
<table class="table table-striped">	
<thead>
	<tr>
		<th>Auto Invoice		
		</th> 
		<th>id</th> 
		<th>sid</th>
		<th>po</th>
		<th>name</th>
		<th>email</th>
		<th>address1</th>
		<th>address2</th>
		<th>city</th>
		<th>state</th>
		<th>zip</th>
		<th>Prepay Amount</th>
		<th>Edit</th>
		<th>Delete</th>
		
	</tr>
</thead>	

@foreach($customers as $customer)

	<tr>
		<td> 
		{{ Form::open(array('url' => 'customers/ajax_update')) }}
		{{-- http://bootsnipp.com/snippets/e3A3a --}}
		<div class="checkbox checkbox-primary">		
		    <input id="{{ $customer->id }}" class="checkbox" type="checkbox" {{ $customer->is_auto_invoice }} >
		    <label for="{{ $customer->id }}"> </label>
		</div>    	
		{{ Form::close() }} 


		</td>
		<td> {{ $customer->id }} </td>	
		<td> {{ $customer->sid }} </td>
		<td> {{ $customer->po }} </td>
		<td> {{ $customer->name }} </td>
		<td> {{ $customer->email }} </td>
		<td> {{ $customer->address1 }}</td>
		<td> {{ $customer->address2 }}</td>
		<td> {{ $customer->city }}</td>
		<td> {{ $customer->state }}</td>
		<td> {{ $customer->zip }}</td>
		<td> {{ $customer->prepay_amount }}</td>

		<td> 
		{{-- {{ link_to_route('customers.edit','Edit or Create Invoice', [$customer->id],['class' =>'btn btn-default btn-sm'] ) }}  --}}
		
		<a href="{{ URL::route('customers.edit', array('id' => $customer->id)) }}" class="btn btn-default btn-sm">
        <span class="glyphicon glyphicon-pencil"></span> Edit or Create Invoice


    	</a>

		</td>
		

		


		
		<td>
			{{Form::model($customer, ['route' => ['customers.destroy',$customer->id], 'method'=>'delete' ] ) }}
				{{Form::button('<span class="glyphicon glyphicon-trash"></span>', ['type'=>'submit','class'=>'btn btn-sm btn-default'])}}

			{{Form::close() }}
		</td>
		
	</tr>
@endforeach

</table>

@if($paginate)
	{{ $customers->links() }}
@endif

@stop




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


<h5>Filters:</h5>	
{{ Form::model('Invoice', array('route'=> ['invoices.index'], 'method'=>'GET','class' => 'form-inline well' ) )}}
{{-- {{ Form::open( array('route' => 'customers.index','class' => 'form-inline well') )}} --}}

  <div class="form-group">
    <label for="exampleInputName2">Search sid</label>
    <input type="text" name="sid" value="{{ $sid }}" class="form-control" id="exampleInputName2" placeholder="">
    &nbsp;&nbsp;
  </div>

  <div class="form-group">
    <label for="exampleInputEmail2">Search Name</label>
    <input type="text" name="name" value="{{ $name }}" class="form-control" id="exampleInputEmail2" placeholder="">
    &nbsp;&nbsp;
  </div>

  

	{{Form::button('submit', ['type'=>'submit','class'=>'btn btn-sm btn-default'])}}

{{ Form::close() }} 



<h2>Invoices:</h2>
<table class="table table-striped">	
<thead>
	<tr>
		
		<th>customer sid</th> 
		<th>invoice_id</th>
		<th>customer_name</th>
		<th>customer created_at</th>
		<th>customer updated_at</th>
		<th>sent_date</th>		
		<th>View</th>
		<th>Download</th>		
		{{-- <th>Delete</th> --}}
		
	</tr>
</thead>	

@foreach($invoices as $invoice)

	<tr>
		
		{{--
		{{ Form::open(array('url' => 'foo/bar')) }}
		 http://bootsnipp.com/snippets/e3A3a 
		    	
		{{ Form::close() }} 
		--}}


		
		<td> {{ $invoice->sid }} </td>	
		<td> {{ $invoice->invoice_id }} </td>	
		<td> {{ $invoice->name }} </td>	
		<td> {{ $invoice->created_at }} </td>	
		<td> {{ $invoice->updated_at }} </td>	
		<td> {{ $invoice->sent_date }} </td>	
		
		<td> <a href="pdfs/{{ $invoice->invoice_id }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-eye-open"></span> View</a></td>

		<td> <a href="pdfs/{{ $invoice->invoice_id }}" download="{{ $invoice->invoice_id }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-download-alt"></span>Download</a></td>
		
		{{-- <td>
			{{Form::model($invoice, ['route' => ['invoices.destroy',$invoice->id], 'method'=>'delete' ] ) }}
				{{Form::button('<span class="glyphicon glyphicon-trash"></span>', ['type'=>'submit','class'=>'btn btn-sm btn-default'])}}

			{{Form::close() }}
		</td> --}}
		
	</tr>
@endforeach

</table>


@if($paginate) {{ $invoices->links() }} @endif



@stop




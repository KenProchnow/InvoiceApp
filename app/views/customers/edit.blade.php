@extends('templates/main')
@section('content')	



@if (Session::has('message'))
	@if ( Session::get('message_status') == 'failed' )
		<div class="alert alert-danger">
	  	<strong></strong> {{{ Session::get('message') }}}
		</div>
	@endif

	@if ( Session::get('message_status') == 'success' )
		<div class="alert alert-success">
	  	<strong></strong> {{{ Session::get('message') }}}
		</div>
	@endif
	
		
@endif

<div class="container">
<div class="col-sm-5">	
</div>
<div class="col-sm-7">	
{{ link_to_route('invoices.edit','+ Create new invoice', [$customer->id],['class' =>'btn btn-success btn-sm'] )  }}
</div>
    



<div class="container">
<div class="col-sm-5">	



<h2>Edit Customer</h2>
	{{ Form::model($customer, array('route'=> ['customers.update',$customer->id], 'method'=>'PUT','class' => 'form-horizontal' ) )}}
<div class="col-sm-2">

</div>

<div class="col-sm-10">

<br>
</div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">po</label>
    <div class="col-sm-10">
    	{{ Form::text('po',$customer->po,array('class' => 'form-control')) }}  
    </div>
  </div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">sid</label>
    <div class="col-sm-10">
{{ Form::text('sid',$customer->sid,array('class' => 'form-control') ) }}
	</div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
{{ Form::text('name',$customer->name,array('class' => 'form-control')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Address1</label>
    <div class="col-sm-10">
{{ Form::text('address1',$customer->address1,array('class' => 'form-control' )) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Address2</label>
    <div class="col-sm-10">
{{ Form::text('address2',$customer->address2,array('class' => 'form-control')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">City</label>
    <div class="col-sm-10">
{{ Form::text('city',$customer->city,array('class' => 'form-control')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">State</label>
    <div class="col-sm-10">
{{ Form::text('state',$customer->state,array('class' => 'form-control')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Zip</label>
    <div class="col-sm-10">
{{ Form::text('zip',$customer->zip,array('class' => 'form-control')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">email</label>
    <div class="col-sm-10">
{{ Form::text('email',$customer->email,array('class' => 'form-control')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Prepay Amount</label>
    <div class="col-sm-10">
{{ Form::text('prepay_amount',$customer->prepay_amount,array('class' => 'form-control')) }}
	</div>
</div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {{ Form::submit('update',array('class'=>'btn btn-info')) }}  
    </div>
  </div>

{{ Form::close() }}	
</div>   {{-- end of span 5 --}}

<div class="col-sm-7">	


<h2>Invoice History</h2>

<table class="table table-striped">
	<thead>
	  <tr>
	    <th>id</th>
	    <th>invoice_id</th>
	    <th>created_at</th>
	    <th>file name</th>
	    <th>sent_date</th>
	    <th>view Invoice</th>
	    <th>send</th>		        
	  </tr>
	</thead>
	<tbody>

	@foreach ($invoices as $invoice)
		</tr> 
			<td> {{ $invoice->id }} </td>
			<td> {{ $invoice->invoice_id }} </td>
			<td> {{ $invoice->created_at }} </td>
			<td> {{ $invoice->invoice_id }} </td> 
			<td> {{ $invoice->sent_date }} </td> 
			<td> {{ link_to('pdfs/'.$invoice->invoice_id, 'View Invoice') }}  </td> 
			<td> {{ link_to_route('phpmailer.edit','Send Invoice',$paramters = array('customer_id'=>$customer->id,'invoice_id'=>$invoice->id),['class'=>'btn btn-sm btn-default'] ) }}  </td> 
			

			<td>
			{{Form::model($invoice, ['route' => ['invoices.destroy',$invoice->id], 'method'=>'delete' ] ) }}
				{{Form::button('delete', ['type'=>'submit','class'=>'btn btn-sm btn-danger'])}}
			{{Form::close() }}
		    </td>
				
			
			


			
		</tr>
	@endforeach

	</tbody>
</table>




</div>   {{-- end of span 5 --}}
</div>    {{-- end of container --}}




@stop




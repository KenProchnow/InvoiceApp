@extends('templates/main')
@section('content')	


<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

</style>



<div class="container">
<div class="row">
<div class="col-sm-6">




{{ Form::open( array('route' => 'customers.store','class' => 'form-horizontal') )}}

<div class="col-sm-2">

</div>

<div class="col-sm-10">
<h3>Create New Customer:</h3>
<br>
</div>




  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">po</label>
    <div class="col-sm-10">
    	{{ Form::text('po','',array('class' => 'form-control', 'placeholder' => 'po')) }}
    </div>
  </div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">sid</label>
    <div class="col-sm-10">
{{ Form::text('sid','',array('class' => 'form-control', 'placeholder' => 'sid') ) }}
	</div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
{{ Form::text('name','',array('class' => 'form-control', 'placeholder' => 'name')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
{{ Form::text('email','',array('class' => 'form-control', 'placeholder' => 'email')) }}
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Address1</label>
    <div class="col-sm-10">
{{ Form::text('address1','',array('class' => 'form-control', 'placeholder' => 'address1')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Address2</label>
    <div class="col-sm-10">
{{ Form::text('address2','',array('class' => 'form-control', 'placeholder' => 'address2')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">City</label>
    <div class="col-sm-10">
{{ Form::text('city','',array('class' => 'form-control', 'placeholder' => 'city')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">State</label>
    <div class="col-sm-10">
{{ Form::text('state','',array('class' => 'form-control', 'placeholder' => 'state')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Zip</label>
    <div class="col-sm-10">
{{ Form::text('zip','',array('class' => 'form-control', 'placeholder' => 'zip')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Prepay Amount</label>
    <div class="col-sm-10">
{{ Form::text('prepay_amount','',array('class' => 'form-control', 'placeholder' => 'prepay_amount')) }}
	</div>
</div>

{{ Form::hidden('form_type', 'one_entry') }}


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {{ Form::submit('Create',array('class'=>'btn btn-info')) }}  
    </div>
  </div>

{{ Form::close() }}	



</div>    {{-- end of first half --}}


<div class="col-sm-1 gutter">

</div>

<div class="col-sm-5">

<h3>CSV Import for Many Customers:</h3>
<br>

{{ Form::open( array('route' => 'customers.store','files'=>true) )}}



  

  {{ Form::file('file',array('class'=>'') ) }}


  <br/>

  {{ Form::hidden('form_type', 'mass_entry') }}
  <!-- submit buttons -->
  {{ Form::submit('Create',array('class'=>'btn btn-info')) }}
  
  <!-- reset buttons -->
  {{-- {{ Form::reset('Reset',array('class'=>'btn btn-default')) }} --}}
  
  {{ Form::close() }}

</div> {{-- end of second half --}}




</div>    {{-- end of row --}}
</div>  {{--  end of container--}}


 





@stop




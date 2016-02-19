@extends('templates/main')
@section('content')	

<h3>Settings:</h3>


<div class="container">
<div class="row">
<div class="col-sm-6">

{{ Form::open( array('route' => 'settings.store','class' => 'form-horizontal') )}}

<div class="col-sm-2">

</div>

<div class="col-sm-10">
<h3>Create info:</h3>
<br>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Company Name</label>
    <div class="col-sm-10">
{{ Form::text('name','',array('class' => 'form-control', 'placeholder' => 'name')) }}
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
    <label for="inputEmail3" class="col-sm-2 control-label">Gmail password</label>
    <div class="col-sm-10">
{{ Form::text('email','',array('class' => 'form-control', 'placeholder' => 'email')) }}
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gmail token</label>
    <div class="col-sm-10">
{{ Form::text('email','',array('class' => 'form-control', 'placeholder' => 'email')) }}
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Upload Your Logo</label>
    <div class="col-sm-10">
	{{ Form::file('file',array('class'=>'') ) }}
	</div>
</div>


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




</div> {{-- end of second half --}}




</div>    {{-- end of row --}}
</div>  {{--  end of container--}}




@stop




@extends('templates/main')
@section('content')	

<h3>Settings:</h3>


<div class="container">
<div class="row">
<div class="col-sm-6">
{{-- 
{{ Form::open( array('route' => 'settings.update','class' => 'form-horizontal') )}} 
--}}
{{ Form::model($settings, array('route'=> ['settings.update',$settings->id], 'method'=>'PUT','class' => 'form-horizontal' ) )}}
<div class="col-sm-2">

</div>

<div class="col-sm-10">
<h3>Update info:</h3>
<br>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Company Name</label>
    <div class="col-sm-10">
{{ Form::text('name',$settings->name,array('class' => 'form-control', 'placeholder' => 'name')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Address1</label>
    <div class="col-sm-10">
{{ Form::text('address1',$settings->address1,array('class' => 'form-control', 'placeholder' => 'address1')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Address2</label>
    <div class="col-sm-10">
{{ Form::text('address2',$settings->address2,array('class' => 'form-control', 'placeholder' => 'address2')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">City</label>
    <div class="col-sm-10">
{{ Form::text('city',$settings->city,array('class' => 'form-control', 'placeholder' => 'city')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">State</label>
    <div class="col-sm-10">
{{ Form::text('state',$settings->state,array('class' => 'form-control', 'placeholder' => 'state')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Zip</label>
    <div class="col-sm-10">
{{ Form::text('zip',$settings->zip,array('class' => 'form-control', 'placeholder' => 'zip')) }}
	</div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email (must be gmail)</label>
    <div class="col-sm-10">
{{ Form::text('email',$settings->email,array('class' => 'form-control', 'placeholder' => 'email')) }}
    </div>
</div>

{{-- <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gmail password</label>
    <div class="col-sm-10">
        <input name="password" type="password" class="form-control" value="{{$settings->password}}"> --}}

{{-- {{ Form::password('password',$settings->password,array('class' => 'form-control', 'placeholder' => 'email')) }} 
--}}

{{--     </div>
</div> --}}

<p>You must enable two factor authentication in your gmail account, and then create a token to enter below:</p>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gmail email token</label>
    <div class="col-sm-10">
        <input name="email_token" type="password" class="form-control" value="{{$settings->email_token}}">

    </div>
</div>



{{-- <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gmail token</label>
    <div class="col-sm-10">
{{ Form::text('email_token',$settings->email_token,array('class' => 'form-control', 'placeholder' => 'email')) }}
    </div>
</div> --}}


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {{ Form::submit('Update',array('class'=>'btn btn-info')) }}  
    </div>
  </div>

{{ Form::close() }}	


  <br/>



{{ Form::open( array('route'=> ['settings.store'],'files'=>true) )}}


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Upload Your Logo</label>
    <div class="col-sm-10">
    {{ Form::file('file',array('class'=>'') ) }}
    </div>
</div>
<!-- submit buttons -->

<div class="col-sm-2">

</div>
<br/><br/>
<div class="col-sm-10">

  {{ Form::submit('Create',array('class'=>'btn btn-info')) }}
</div>



{{ Form::close() }} 


</div>    {{-- end of first half --}}


<div class="col-sm-1 gutter">

</div>

<div class="col-sm-5">

<h3>Info to Appear on Invoice:</h3>


{{ $settings->name }}
<br>
{{ $settings->address1 }}
{{ $settings->address2 }}
<br>
{{ $settings->city }}
<br>
{{ $settings->state }}
<br>
{{ $settings->zip }}
<br>
{{ HTML::image('uploads/logo/'.$settings->logo,'logo',array('width' => '300px')) }}






</div> {{-- end of second half --}}




</div>    {{-- end of row --}}
</div>  {{--  end of container--}}




@stop




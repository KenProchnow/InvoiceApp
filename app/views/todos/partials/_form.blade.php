{{ $errors->first('name','<div class="alert alert-danger">:message</div>') }}
{{ Form::label('name','List Title') }}
{{ Form::text('name') }}
{{ Form::submit('update',array('class'=>'btn btn-info')) }}
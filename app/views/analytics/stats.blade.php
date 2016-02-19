{{-- {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js') }} --}}
{{-- {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.2/highcharts.js') }} --}}

 
{{-- <script src=" {{asset('/js/Highcharts-4.1.7/js/highcharts.js')}} " ></script> --}}

@extends('templates/main')
@section('content')	

<style>

</style>


<br>

{{-- <pre>{{ print_r($chartArray) }}</pre> --}}

<script type="text/javascript">
$(function() {
  $('#container').highcharts(
    {{json_encode($chartArray,JSON_NUMERIC_CHECK)}}
  )

  $('#container2').highcharts(
    {{json_encode($chartArray2,JSON_NUMERIC_CHECK)}}
  )

  $('#container3').highcharts(
    {{json_encode($chartArray3,JSON_NUMERIC_CHECK)}}
  )

  $('#container4').highcharts(
    {{json_encode($chartArray4,JSON_NUMERIC_CHECK)}}
  )

  $('#container5').highcharts(
    {{json_encode($chartArray5,JSON_NUMERIC_CHECK)}}
  )

  $('#container6').highcharts(
    {{json_encode($chartArray6,JSON_NUMERIC_CHECK)}}
  )

});


</script>

</div> {{-- end container --}}
<div class="container-fluid ">
  
  

  <div class="row">
    <div class="text-center col-md-4">
      <div id="container2" style="width:500px;height:300px;"></div>
    </div>
    <div class="text-center col-md-4">
      <div id="container" style="width:500px;height:300px;"></div>
    </div>
    <div class="text-center col-md-4">
      <div id="container3" style="width:500px;height:300px;"></div>
    </div>
  </div> {{-- end of row --}}

  <div class="row">
    <div class="text-center col-md-4">
        <div id="container4" style="width:500px;height:300px;"></div>
    </div>
    <div class="text-center col-md-4">
      <div id="container6" style="width:500px;height:300px;"></div>
    </div>
    <div class="text-center col-md-4">
      <div id="container5" style="width:500px;height:300px;"></div>
    </div>
  </div> {{-- end of row --}}


 {{--</div>   end of container on main template --}}





@stop


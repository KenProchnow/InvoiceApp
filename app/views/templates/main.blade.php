<!doctype html>

<style>
ul,li{
	text-decoration: none;
	list-style-type: none;
	/*font-size: 16px;*/
}
</style> 

{{-- <script src="js/bootstrap.js" ></script> --}}
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js') }}
<script src=" {{asset('js/bootstrap.js')}} " ></script>

{{-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css">  --}}
<link rel="stylesheet" type="text/css" href=" {{ asset('css/bootstrap.css') }} "> 
<link rel="stylesheet" type="text/css" href=" {{ asset('css/styles.css') }} "> 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">


<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />

	
</head>


{{-- @if ($email = Auth::user()->email ) --}}
  {{-- {{ $email }} --}}
{{-- @endif --}}

    


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">

     <li>
      <a href="{{ action("HomeController@index") }}"> 
      {{ HTML::image("images/invoicePilotLogo.png", '', array('width'=>50,'style'=>'padding: 5px' ) ) }} 
      </a>
      {{--{{ HTML::image('uploads/logo/'.$settings->logo,'logo',array('height' => '50px')) }}       

      &nbsp; &nbsp; &nbsp;&nbsp;  </li>
      --}}  
    </div>
    <ul class="nav navbar-nav">
      {{-- <li> {{ link_to_route('todos.index','ToDo List')}} </li>   
      <li> {{ link_to_route('expenses.index','Expenses')}} </li> --}}
      <li><a class="navbar-brand" href="{{ action("HomeController@index") }}">Invoice Pilot</a></li>
      <li> {{ link_to_route('customers.index','Customers')}} </li>
      <li> <a href="{{ action("InvoiceController@index") }}">Invoices</a></li>   
      <li> <a href="{{ action("AnalyticsController@customers") }}">Customer Analytics</a></li>   
      <li> <a href="{{ action("AnalyticsController@stats") }}">Customer Stats</a></li>   
      <li> <a href="{{ action("SettingsController@index") }}">Settings</a></li>   
      
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      

      

      
      @if (Auth::check())
          <?php
          $id = Auth::user()->id;      
          $user = DB::table('settings')->where('user_id', '=', $id)->first();
          $settings = Setting::findOrFail($user->id);
          ?>
      
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</a></li>
      <li style="margin-top:8px">{{ HTML::image('uploads/logo/'.$settings->logo,'logo',array('height' => '30px')) }}</li>
      <li><a href="{{ url('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>

      
      @else
        <li><a href="{{ url('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="{{ url('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      @endif
      
      
    </ul>
  </div>
</nav>


<div class="container">



		@yield('content')



<hr>
<p>Footer</p>

</div> {{-- end container --}}




 {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.2/highcharts.js') }}
  {{ HTML::script('js/app.js') }}
</html>

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//--------------------------------------------------------------------
// Route::get('/', function()
// {
// 	// return View::make('analytics.index');
	
// });

Route::get('analytics', function()
{
	return View::make('analytics');
	
	
});



Route::get('/reset', function(){
	// return "hello";
	return View::make('Reset_password');
});

	


//--------------------------------------------------------------------
// Route::get('about', function()
// {
// 	return 'this is the content';
// });

//--------------------------------------------------------------------
// Route::get('hello2', function()
// {
// 	// 3 ways to pass a param to a view.
// 	// return View::make('hello2', array('name'=>'Ken') );
// 	return View::make('hello2')->with('name','Ken');
// 	// return View::make('hello2')->withName('Ken');
// });

//--------------------------------------------------------------------
Route::get('hello3/{name?}', function($name="empty")
{
	//optional param
	// return View::make('hello2')->with('name',$name);
	$data = [
	'name'=>'Ken',
	'lname'=>'Prochnow',
	'phone'=>'619-804-3348',
	'malicious'=>'<script>window.alert("dont trust this user input");</script>'
	];

	// return View::make('hello2')->with($data); // this is how you have access to individual variables of the array
	return View::make('hello4')->with($data); // this is how you access the entire array, can uses sections or loops. 
	
});


//--------------------------------------------------------------------

// Route::get('about/{theSubject}', function($theSubject)
// {
// 	return  'content on ' . $theSubject;
// });

//--------------------------------------------------------------------

// Route::get('content/directions', array(
	
// 	'as'=> 'directions', 
	
// 	function(){
// 	$theURL = URL::route('directions');
// 	return  'directions go to this url ' . $theURL;
	
// 	})
// );

//--------------------------------------------------------------------
// Route::get('about/directions', function()
// {
// 	return 'directions go here';
// });
//--------------------------------------------------------------------
// Route::any('submit-form', function()
// {
// 	return 'Process form';
// });



/**
 * restful routing
 *
 * will need to tie out controller to these routes
 * 
 * /todos = all lists
 * /todos/1 = show
 * /todos/1/edit = edit and update
 * /todos/create = create new list
 */


//--------------------------------------------------------------------
// Route::get('/todos', function()
// {
// 	return View::make('todos.index');
// });

// Route::get('/todos', 'TodoListController');

// Route::get('/db',function(){
// 	return DB:select('select database();');
// });



// Route::get('/analytics/customers', 'AnalyticsController@customers');




Route::get('/logout', function(){
	Auth::logout();
	return View::make('logout');
});



Route::get('/login', function(){
	return View::make('login');
});

Route::post('/login', function(){
	$credentials = Input::only('username','password');
	
	if( Auth::attempt($credentials, true) ){
		return Redirect::intended('/');
	}
	return Redirect::to('login');
});




Route::get('/register', function(){
	return View::make('register');
});

Route::post('/register', function(){
	// return "registered";
	$theEmail = Input::get('email');
	$user = new User;
	$user->email = Input::get('email');
	$user->username = Input::get('username');
	$user->password = Hash::make(Input::get('password'));
	$user->save();
	
	return View::make('thanks');


});

Route::get('/', 'HomeController@index');

Route::get('/password/remind', 'RemindersController@getRemind');
Route::post('/password/remind', 'RemindersController@postRemind');

Route::get('/password/reset/{token}', 'RemindersController@getReset');
Route::post('/password/reset', 'RemindersController@postReset');


// Route::resource('/phpmailer/{customer_id}/edit/{invoice_id}', 'phpMailerController@edit');

	
   	

Route::group(['before' => 'auth'], function()
{
	Route::get('/customers', 'CustomersController@index');
	Route::get('/stats', array('as' => 'stats', 'uses' => 'AnalyticsController@stats'));
	Route::get('/analytics', array('as' => 'analytics', 'uses' => 'AnalyticsController@customers'));
	Route::get('/Invoice/massUpload', 'InvoiceController@massUpload');
	Route::get('/customers/pdf', 'CustomersController@pdf');
	Route::post('/customers/ajaxupdate/{id}/{value}/', 'CustomersController@updateCustomerRecord');   
	Route::get('/customers/export', 'CustomersController@export');
	// Route::post('/settings/upload', 'SettingsController@upload');
	
	Route::resource('/settings', 'SettingsController');
	Route::resource('/todos', 'TodoListController');
	Route::resource('/expenses', 'ExpensesController');
	Route::resource('/customers',  'CustomersController' );
	Route::resource('/invoices', 'InvoiceController');
	Route::resource('/phpmailer', 'phpMailerController');
});

// Route::get('/todos',s 'TodoListController@index');
// Route::get('/todos/{id}', 'TodoListController@show');






// Route::get('/todos/{id}', function($id)
// {
// 	return View::make('todos.show')->withId($id);
// });


// not sure what this is doing anymore
// Event::listen('illuminate.query',function($query){
// 	// var_dump($query);
// });

//--------------------------------------------------------------------
Route::get('/db', function()
{
	// return DB::select('select database();');
	// return DB::connection()->getDatabaseName();
	// return DB::select('show tables;');
	// DB::table('todo_lists')->insert(
	// 	array("name"=>"Ken's list")
	// 	);

	// return DB::table('todo_list')->get();
	$result = DB::table('todo_list')->where("name","Your list")->first();
	// var_dump($result)->name;
	return $result->name;
});




















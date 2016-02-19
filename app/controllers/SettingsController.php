<?php

class SettingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$email = Auth::user()->email;		
		$user = DB::table('users')	            
	            // ->where('name', '=', '%'.$name.'%')
	            ->where('email', '=', $email)	           
	            ->first();

	      // return var_dump($user->id);

	     $user_settings = DB::table('settings')	            
	            // ->where('name', '=', '%'.$name.'%')
	            ->where('user_id', '=', $user->id)	           
	            ->first();

	     // return var_dump($user_settings);

	     if($user_settings){
	     	// return 'not null';
	     	$settings = Setting::all()->first();
			// return var_dump($settings);	     	
	     	return View::make('settings.edit')->with('settings',$settings);
	     }

	     if($user_settings==null){
	     	// return 'null';
	     	return View::make('settings.index');
	     }
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		

            // dd($user);
			// dd($user->logo);	
			

		if( Input::hasFile('file') ){

			$image = Input::file('file');

	        $filename = time() . '-' . $image->getClientOriginalName();
	        
	        // Moves file to folder on server
	        $image->move(public_path() . '/uploads/Logo/', $filename);


												        // $user->logo = $filename;
												        // dd($user);
												        // $user->update();
	        
	        // REFACTOR THIS - get the user
			// $email = Auth::user()->email;
			// $user = DB::table('users')	            
		 //    ->where('email', '=', $email)	           
   //          ->first();
		 //     										// return var_dump($user->id);	     
   //          $userid = $user->id;

			// $user = DB::table('settings')	            
		 //    ->where('user_id', '=', $userid)	           
   //          ->first();

	        // REFACTORED
            $user_id = Auth::user()->id;
            $setting = DB::table('settings')	            
		    ->where('user_id', '=', $user_id)	           
            ->first();
	        $setting = Setting::findOrFail($setting->id);	        
            $setting->logo = $filename;
            $setting->update();

            


		}else{
			$email = Auth::user()->email;
			// return var_dump($email);
			
			$user = DB::table('users')	            
		            // ->where('name', '=', '%'.$name.'%')
		            ->where('email', '=', $email)	           
		            ->first();
		     // return var_dump($user->id);	     

			$input = Input::all();
			$input['user_id'] = $user->id;

			// return var_dump($input);
			Setting::create($input);	
		}

		return Redirect::route('settings.index')->withMessage('new info created')->withMessage_status("success");

	
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$settings = Setting::findOrFail($id);
		return View::make('settings.edit')->with('settings',$settings);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		

		 
			$settings = Setting::findOrFail($id);
			$post_data = Input::all();
			$settings->fill($post_data);
			$settings->update($post_data);	
		

		// $customer = Customer::findOrFail($id);
		// $post_data = Input::all();
		// $customer->fill($post_data);
		// $customer->update($post_data);
		// return "done";
		
		
		// return var_dump($settings);
		// return View::make('settings.edit')->with('settings',$settings);


		return Redirect::route('settings.edit',$id);
	}

	public function upload(){
		return "hello";
		

		return Redirect::route('settings.edit',$id);

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}

<?php

class SettingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		// $email = Auth::user()->email;		
		// $user = DB::table('users')	            
	 //            ->where('email', '=', $email)	           
	 //            ->first();	      

	     $settings = DB::table('settings')	            	            
	            ->where('user_id', '=', Auth::user()->id)	           
	            ->first();

	     if($settings){	     	
	     	return View::make('settings.edit')->with('settings',$settings);
	     }
	     if($settings==null){	     	
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

									        // old and has been REFACTORED below
								      		// $user_id = Auth::user()->id;
								      		// $setting = DB::table('settings')	            
										    // ->where('user_id', '=', $user_id)	           
								      		// ->first();
									     	// $setting = Setting::findOrFail($setting->id);	        

	        $setting = Setting::where('user_id',Auth::user()->id)->first();
	     
            $setting->logo = $filename;
            $setting->update();

            


		}else{
			// $email = Auth::user()->email;
			// // return var_dump($email);
			
			// $user = DB::table('users')	            
		 //            // ->where('name', '=', '%'.$name.'%')
		 //            ->where('email', '=', $email)	           
		 //            ->first();
		 //     // return var_dump($user->id);	
		     
		     // $user = User::where('user_id',Auth::user()->id)->first();     

			$input = Input::all();
			$input['user_id'] = Auth::user()->id;

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

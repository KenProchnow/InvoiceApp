<?php


class CustomersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
			        $this->beforeFilter('auth', array('except' => 'getLogin'));

			
			


		if(Input::get('sid') || Input::get('name') || Input::get('prepay_amount')){
			// Sets the parameters from the get request to the variables.
	        $sid = Input::get('sid');
	        $name = Input::get('name');
	        $prepay_amount = Input::get('prepay_amount');

	        // Perform the query using Query Builder
	        $customers = DB::table('customers')	            
	            // ->where('name', '=', '%'.$name.'%')
	            ->where('sid', 'like', '%'.$sid.'%')
	            ->where('name', 'like', '%'.$name.'%')
	            ->where('prepay_amount', '>=', $prepay_amount)	
	            ->where('user_id', '=', Auth::user()->id)// -------------------------------------------------only logged in user            
	            ->get();
	        
	        $paginate = false;
	        return View::make('customers.index')
	        ->with('customers',$customers)
	        ->with('paginate',$paginate)
	        ->with('sid',$sid)
	        ->with('name',$name)
	        ->with('prepay_amount',$prepay_amount);

		}else{
			$sid = "";
	        $name = "";
	        $prepay_amount = "";

	        
			$customers = Customer::where('user_id',Auth::user()->id)->paginate(15);// -------------------------------------------------only logged in user

			// $customers = Customer::orderBy('id')->paginate(15);	
			// $customers = Customer::all();
			
			// return var_dump($customers[0]->is_auto_invoice);

			foreach($customers as $key => $value){

				if($value->is_auto_invoice == true){
					$value->is_auto_invoice = 'checked';
				} else {
					$value->is_auto_invoice = '';
				}
			}

			$paginate = true;
			return View::make('customers.index')
			->with('customers',$customers)
			->with('paginate',$paginate)
			->with('sid',$sid)
	        ->with('name',$name)
	        ->with('prepay_amount',$prepay_amount);
		}	
	}

	public function updateCustomerRecord($id,$value)
    {
    	
    	$customer = Customer::where('user_id',Auth::user()->id)->findOrFail($id);
    	$customer->is_auto_invoice = $value;    	
    	$customer->update();

        // $data = $request->all(); // This will get all the request data.

        // dd($data); // This will dump and die
    }


	public function export()
	{
		// Excel::create('Filename', function($excel) {

		// })->export('xls');

		$customers = Customer::where('user_id',Auth::user()->id)->get();

		$date = date("Y/m/d");
		Excel::create('Prepay_Customers_as_of_'.$date, function($excel) use($customers) {

		    $excel->sheet('Sheet 1', function($sheet) use($customers) {
		        $sheet->fromArray($customers);
		    
		    });

		})->export('csv');

		return Redirect::route('customers.index')->withMessage('file downloaded');


	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return View::make('customers.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{			

		$formtype = Input::get('form_type');


		if($formtype == 'one_entry'){
			$input = Input::all();
			$input['user_id'] = Auth::user()->id;
			// dd($input);
			// return var_dump($input);
			Customer::create($input);
		}

		if($formtype == 'mass_entry'){


				// return "hello";
		
				$file = Input::file('file');
		        $name = time() . '-' . $file->getClientOriginalName();
		        // Moves file to folder on server
		        $file->move(public_path() . '/uploads/CSV', $name);

		        // $excel = App::make('excel');
		        
		        ini_set("auto_detect_line_endings", "1");


				// if ($handle) {
				//     while ($line = fgetcsv($handle)) {
				        
				//     }
				// }
				// 
				// 
			// TRIAL 2

		        $user_id = Auth::user()->id;
			    $results = Excel::load('public/uploads/CSV/'.$name)->get();

			    // var_dump($results);
			    foreach($results as $row){
			    	Customer::create([
			    		'sid'=>$row->sid,
						'po'=>$row->po,
						'name'=>$row->name,
						'address1'=>$row->address1,
						'address2'=>$row->address2,
						'city'=>$row->city,
						'state'=>$row->state,
						'zip'=>$row->zip,
						'credit_limit'=>$row->credit_limit,
						'prepay_amount'=>$row->prepay_amount,
						'email'=>$row->email,
						'user_id'=>$user_id
			    		]);
			    }

			// TRIAL 1


			 //    	$file_handle = fopen('public/uploads/CSV/'.$name, 'r');
				
					
				// 	while (!feof($file_handle) ) {
				// 		$line_of_text[] = fgetcsv($file_handle, 1024);

				// 		// return $line_of_text[0][0];


				// 		Customer::create( array( 										
				// 						'sid'=> $line_of_text[0][0],
				// 						'po'=> $line_of_text[0][1],
				// 						'name'=> $line_of_text[0][2],
				// 						'address1'=> $line_of_text[0][3],
				// 						'address2'=> $line_of_text[0][4],
				// 						'city'=> $line_of_text[0][5],
				// 						'state'=> $line_of_text[0][6],
				// 						'zip'=> $line_of_text[0][7],
				// 						'credit_limit'=> $line_of_text[0][8],
				// 						'type'=> $line_of_text[0][9],										
				// 						'prepay_amount'=> $line_of_text[0][10],
				// 						'email'=> $line_of_text[0][11]
				// 			) 
				// 		);

				// 	}
				// 	fclose($file_handle);									
		    
		}

		return Redirect::route('customers.index')->withMessage('successfully created new customer')->withMessage_status("success");

		
		
	}


	public function pdf()
	{
		

		$pdf = App::make('dompdf');
		$template = View::make('customers.pdf_template');
		$pdf->loadHTML($template);
		$pdf->render();
		file_put_contents('app/views/customers/pdfs/pdf_testing.pdf', $pdf->output());
	
		// $output = $dompdf->output();
		// file_put_contents("/pdf_path/file.pdf", $output);

		return $pdf->stream();

		// $pdf = PDF::loadView('pdf.invoice', $data);
		// return $pdf->download('invoice.pdf');
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
		
		
		
		
		$customer = Customer::where('user_id',Auth::user()->id)->findOrFail($id);// -------------------------------------------------only logged in user			

		$invoices = DB::table('invoices')->where('customer_id', $id)->orderBy('id','desc')->get();

		// return var_dump($customer);

		return View::make('customers.edit')->withCustomer($customer)->withInvoices($invoices);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$customer = Customer::where('user_id',Auth::user()->id)->findOrFail($id);
		$post_data = Input::all();
		$customer->fill($post_data);
		$customer->update($post_data);
		// return "done";
		
		return Redirect::route('customers.edit',$id);

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$customer = Customer::where('user_id',Auth::user()->id)->findOrFail($id);
		$customer->delete();
		$message = 'Customer Deleted';
		$message_status = 'success';
		return Redirect::route('customers.index')->withMessage($message)->withMessage_status($message_status);
		
	}


}

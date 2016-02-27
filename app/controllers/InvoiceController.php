<?php

class InvoiceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		// $customer = Customer::find(125);
		// $invoices = var_dump($customer->invoices);
		// var_dump($invoices);

		
		if(Input::get('sid') || Input::get('name') || Input::get('sent_date') ){
			// Sets the parameters from the get request to the variables.
	        $sid = Input::get('sid');
	        $name = Input::get('name');
	        $sent_date = Input::get('sent_date');

	        // Perform the query using Query Builder
	        $invoices = DB::table('invoices')	            
	            // ->where('name', '=', '%'.$name.'%')  
	            ->select(
	            	'customers.sid',
	            	'invoices.prepay_amount',
	            	'invoices.sent_date',
	            	'invoices.invoice_id',
	            	'customers.name',
	            	'customers.created_at',
	            	'customers.updated_at'
	            	)              
	            ->join('customers', 'customers.id', '=', 'invoices.customer_id')    
	            ->where('customers.sid', 'like', '%'.$sid.'%')
	            ->where('customers.name', 'like', '%'.$name.'%')
	            ->where('invoices.user_id', '=', Auth::user()->id)// -------------------------------------------------only logged in user            
	            ->where('invoices.sent_date', 'like', '%'.$sent_date.'%')
	            ->orderBy('invoices.updated_at', 'desc')
	            ->get();

// $query = "SELECT * FROM invoices WHERE DATE_FORMAT(sent_date, '%Y-%m') = '$date' ";
// $invoices = DB::select(DB::raw($query)); 

	        $sent_dates = Invoice::dates();

	        $paginate = false;
	        return View::make('invoice.index')
	        ->with('invoices',$invoices)
	        ->with('paginate',$paginate)
	        ->with('sid',$sid)
	        ->with('name',$name)
	        ->with('sent_date',$sent_date)
	        ->with('sent_dates',$sent_dates);

		}else{
		
		$invoices = DB::table('invoices')
			// ->select('customers.sid', 'invoices.name', 'invoices.prepay_amount','invoices.id','invoices.sent_date','invoices.invoice_id' )	            			
			->select(
	            	'customers.sid',
	            	'invoices.prepay_amount',
	            	'invoices.sent_date',
	            	'invoices.invoice_id',
	            	'customers.name',
	            	'customers.created_at',
	            	'customers.updated_at'
	            	)
            ->join('customers', 'customers.id', '=', 'invoices.customer_id')
            ->where('invoices.user_id', '=', Auth::user()->id)// -------------------------------------------------only logged in user                
            ->orderBy('invoices.updated_at', 'desc')
            ->paginate(15);

            // dd($invoices);

		$paginate = true;
		$sid = "";
        $name = "";
        $sent_date = "";

		$sent_dates = Invoice::dates();

		// dd($dates);

		return View::make('invoice.index')->with('sent_dates',$sent_dates)
		->with('invoices',$invoices)
		->with('paginate',$paginate)
		->with('sid',$sid)				
        ->with('name',$name)
        ->with('sent_dates',$sent_dates);
		// return View::make('invoice.index')->with('invoices',$invoices);
		// return var_dump($invoices);
		}
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{



		$pdf = App::make('dompdf');

		$customer = Customer::where('user_id',Auth::user()->id)->findOrFail($id);
		// return "<pre> print_r($customer) </pre>";
		// return View::make('customers.pdf_template')->withCustomer($customer); //->with("customer",$customer)
		$template = View::make('customers.pdf_template')->withCustomer($customer); //->with("customer",$customer)
		$pdf->loadHTML($template);
		$pdf->setPaper('letter');
		// $pdf->set_base_path(realpath(APPLICATION_PATH . '../../public/css/bootstrap.css'));
		
		$name = strtoupper(substr( $customer->name ,0,3)) . rand(100000,20000) . date("Y-m-d") . ".pdf";
		

		$pdf->render();
		file_put_contents('app/views/customers/pdfs/'.$name, $pdf->output());
		$stream = $pdf->stream();

		return $stream;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		

		$customer = Customer::where('user_id',Auth::user()->id)->findOrFail($id);
		// $name = strtoupper(substr( $customer->name ,0,3)) . date("Y-m-d") . ".pdf";
		$name = strtoupper(substr( $customer->name ,0,3)) ."-". rand(100000,20000) ."-". date("Y-m-d") . ".pdf";
		
		$pdf->loadHTML($template);
		$pdf->setPaper('letter');
		// $pdf->set_base_path(realpath(APPLICATION_PATH . '../../public/css/bootstrap.css'));
		
		
		
		$pdf->render();
		$stream = $pdf->stream();
		return $stream;
		
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	    $settings = Setting::where('user_id',Auth::user()->id)->first();	    
		$pdf = App::make('dompdf');
		$customer = Customer::where('user_id',Auth::user()->id)->findOrFail($id);

		// return "<pre> print_r($customer) </pre>";
		// return View::make('customers.pdf_template')->withCustomer($customer); //->with("customer",$customer)
		$template = View::make('customers.pdf_template')->withCustomer($customer)->with('settings',$settings); 
		$pdf->loadHTML($template);
		$pdf->setPaper('letter');

		// $name = strtoupper(substr( $customer->name ,0,3)) . date("Y-m-d") . ".pdf";
		$name = strtoupper(substr( $customer->name ,0,3)) ."-". rand(100000,20000) ."-". date("Y-m-d") . ".pdf";

		// uncomment this for testing the pdf template
		// $stream = $pdf->stream();
		// return $stream;
		
		// dd($customer->prepay_amount);

		$insert = array();
		$insert['invoice_id'] = $name;
		$insert['customer_id'] = $customer->id;
		$insert['prepay_amount'] = $customer->prepay_amount;
		$insert['user_id'] = Auth::user()->id;



		Invoice::create($insert);

		// $pdf->set_base_path(realpath(APPLICATION_PATH . '../../public/css/bootstrap.css'));
		
		$pdf->render();
		file_put_contents('public/pdfs/'.$name, $pdf->output());
		
		
		return Redirect::route('customers.edit',$id);
		
		// return View::make('customers.display_pdf')->withStream($stream);
		// $output = $dompdf->output();
		// file_put_contents("/pdf_path/file.pdf", $output);
		
	}

	public function massUpload(){

	    // $email = Auth::user()->email;       
	    // $_user = DB::table('users')->where('email', '=', $email)->first();
	    // $user = DB::table('settings')->where('user_id', '=', $_user->id)->first();
	    // $settings = Setting::findOrFail($user->id);
        
        $settings = Setting::where('user_id',Auth::user()->id)->first();	    
	    $pdf = App::make('dompdf');
	    // $customer = Customer::where('user_id',Auth::user()->id)->findOrFail($id);

		$customers_with_auto = DB::table('customers')
		->where('user_id',Auth::user()->id)
		->where('is_auto_invoice', '=', 1)
		->get();

		foreach ($customers_with_auto as $customer) {
    		// return $customer->name;

    		$pdf = App::make('dompdf');
	
			$template = View::make('customers.pdf_template')->withCustomer($customer)->with('settings',$settings); //->with("customer",$customer)
			$pdf->loadHTML($template);
			$pdf->setPaper('letter');

			$name = strtoupper(substr( $customer->name ,0,3)) ."-". rand(100000,20000) ."-". date("Y-m-d") . ".pdf";		
			
			$insert = array();

			$insert['invoice_id'] = $name;
			$insert['customer_id'] = $customer->id;
			$insert['prepay_amount'] = $customer->prepay_amount;
			$insert['user_id'] = Auth::user()->id;

			Invoice::create($insert);
		
			$pdf->render();
			file_put_contents('public/pdfs/'.$name, $pdf->output());

			$customer_id = $customer->id;
			$invoice_id = $name ;

			// $invoice = DB::table('invoices')->where('invoice_id', '=', $invoice_id)->first();
	
			// $controller = app()->make('App\Http\Controllers\phpMailerController');
			
			// app()->call([$controller, 'massSend'], $parameters);

							// app('App\Http\Controllers\phpMailerContoller')->massSend($parameters);
							
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
        
					        // $setting = Setting::findOrFail($user->id);
				            
						//copy your signature from gmail by composing a message, then inspecting element, then copying the html and css into the $signature variable below. 
						$signature = '
						<div class="gmail_signature"><div dir="ltr"><div><div><b><span style="font-family: arial,helvetica,sans-serif;">Ken Prochnow</span></b><br></div><span style="color: rgb(11, 83, 148);">kenprochnow@gmail.com<br></span></div><span style="color: rgb(11, 83, 148);">619 804 3348</span><br></div></div>
						';

						/**
						* Initiate the PHPMailer class and set properties to work with gmail's server
						*/
						// require_once("PHPMailer/class.phpmailer.php");
						// require_once("PHPMailer/class.smtp.php");
						$username = "kenprochnow@gmail.com";
						
						$password = $settings->email_token;
						$mail = new PHPMailer(); // create a new object
						$mail->IsSMTP(); // enable SMTP
						// $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
						$mail->SMTPAuth = true; // authentication enabled REQUIRED for GMail
						$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
						$mail->Host = "smtp.gmail.com";
						$mail->Port = 465; // or 587
						$mail->IsHTML(true); //true so you can send with signature and <br> tags
						$mail->Username = $username;
						$mail->Password = $password;
						$mail->SetFrom($username);
						// $mail->AddCC('person2@domain.com', 'Person Two');

						/**
						* Read from csv file for mass emailings
						*/

						// Must specify line ending for csv file
						ini_set('auto_detect_line_endings',true);

						$spacer = '<br/><br/>';

						/** 
						* Loop through the multi-dimensional array built from the csv file
						*
						* instantiate the mailer class each iteration and send the mail
						*
						* An alternative would be to bcc everyone on the array and only instantiate once.
						*/

						// foreach($data as $row){

						   $customer = Customer::findOrFail($customer_id);	
						   // $invoice = Invoice::findOrFail($invoice_id);					   

						   //make an array of emails addresses. 
						   $email_to = explode(",", $customer->email); 
						   		   
						   // loop through the array and add the email address. May need to use AddCC() if somethings goes wrong later.
						   foreach($email_to as $email)
								{
								   $mail->AddAddress($email);
								}

						   $email   = $customer->email;
						   $subject = 'Prepay Invoice';

						   $body    = "Hi ".$customer->name .", Please find your invoice attached. Let us know if you have any questions.";
						   $body .=$spacer;
						   $body .=$signature;
						   
						   $attachment = 'public/pdfs/'.$invoice_id;   

						   $mail->AddAttachment($attachment);
						   $mail->Subject = $subject;
						   
						   $mail->Body = $body; 

						  

						   if($mail->Send() ){
							   $today = date('Y-m-d', strtotime('now'));

							   

							   DB::table('invoices')
							   ->where('invoice_id', $invoice_id )
							   ->update(array('sent_date' => $today, 'prepay_amount' => $customer->prepay_amount ));	

							   $message_status = "success";
							   $message = "Sent Email";
						   } else {
						   		$message_status = "failed";
								$message = "Email failure. " . $mail->ErrorInfo;
						   }

						   $mail->ClearAllRecipients();
			};
			
		return Redirect::route('customers.index');

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// return $id;
		// $customer = Customer::findOrFail($id)		
		$invoice = Invoice::where('user_id',Auth::user()->id)->findOrFail($id);
		$customer_id = $invoice->customer_id;

		if($invoice->sent_date == null){
			$message = "invoice deleted";
			$message_status = "success";
			$invoice->delete(); //do an update for the flag, so you never actually delete an invoice.

		}
		if($invoice->sent_date !== null){
			$message = "Can't delete a sent invoice";
			$message_status = "failed";
		}
		
		
		return Redirect::route('customers.edit',$customer_id)->withMessage($message)->withMessage_status($message_status);
			
	}


}

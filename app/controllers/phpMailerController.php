<?php

class phpMailerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	$mail = new PHPMailer();
	return var_dump($mail);		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function edit($parameters)
	{
		
		// Refactor this		
			$customer_id = $parameters;
			$invoice_id = Input::get('invoice_id');	
		



		// REFACTOR THIS - get the user
			$email = Auth::user()->email;
			$user = DB::table('users')	            
		    ->where('email', '=', $email)	           
            ->first();
		     										// return var_dump($user->id);	     
            $userid = $user->id;

			$user = DB::table('settings')	            
		    ->where('user_id', '=', $userid)	           
            ->first();


	        
	        $setting = Setting::findOrFail($user->id);
            
            




		// return var_dump($_GET['invoice_id']);

		
		
		// $filename = "mail.csv";

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
		
		$password = $setting->email_token;
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

		// open the file
		// $file = fopen($filename,'r');

		/**
		* @var array Get the first row and create an array
		*/
		// $header = fgetcsv($file,'r');

		/* 
		Build a a multi-dimensional array so that all row values map to the column name
		@return array of arrays that house all data from csv file.
		*/

		// $data = array();

		// while($row = fgetcsv($file)){
		//    $arr = array();
		//    foreach ($header as $i => $col){
		//       $arr[$col] = $row[$i];
		//       }
		//    $data[] = $arr;
		   
		// }


		/** 
		* print for testing
		*
		*/

		// echo "<pre>";
		// print_r($data);   
		// echo "</pre>";


		// close the file
		// fclose($file);


		/** 
		* $body an be used as a replacement to what is in the csv file for body
		*
		* would be used if you want to make the csv file simpler to use.
		*
		*/

		// $body = "
		// Hello,
		// <br/><br/>
		// This is a friendly reminder that you currently have a past due balance on your account.  If payment has recently been made or is en route, please disregard this email.  If not, please process payment immediately to avoid possible service disruptions.
		// <br/><br/>
		// Please reply directly to this email if you need a copy of your past due invoice(s), or require payment instructions.
		// <br/><br/>
		// Thank you,
		// <br/><br/>
		// ";


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
		   $invoice = Invoice::findOrFail($invoice_id);
		   

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
		   
		   $attachment = 'public/pdfs/'.$invoice->invoice_id;   

		   $mail->AddAttachment($attachment);
		   $mail->Subject = $subject;

		   
		   $mail->Body = $body; 
		   

		   // echo !$mail->Send() ? "$email Failed" . $mail->ErrorInfo : "$email successfully sent";    
		   
		   // $message = !$mail->Send() ? "Email failure. " . $mail->ErrorInfo : "Sent Email";    			

		   if($mail->Send() ){
			   $today = date('Y-m-d', strtotime('now'));
			   DB::table('invoices')->where('id', $invoice->id )->update(array('sent_date' => $today ));	
			   $message_status = "success";
			   $message = "Sent Email";
		   } else {
		   		$message_status = "failed";
				$message = "Email failure. " . $mail->ErrorInfo;
		   }
		   
		   
		   return Redirect::route('customers.edit',$customer_id)->withMessage($message)->withMessage_status($message_status);


		   $mail->ClearAllRecipients();

// }
	}

public function massSend($parameters)
	{
		// dd($parameters);
		// Refactor this
		if(count($parameters>1)){
			$customer_id = $parameters[0];
			$invoice_id = $parameters[1];
		}



		// REFACTOR THIS - get the user
			$email = Auth::user()->email;
			$user = DB::table('users')	            
		    ->where('email', '=', $email)	           
            ->first();
		     										// return var_dump($user->id);	     
            $userid = $user->id;

			$user = DB::table('settings')	            
		    ->where('user_id', '=', $userid)	           
            ->first();


	        
	        $setting = Setting::findOrFail($user->id);
            
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
		
		$password = $setting->email_token;
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
		   $invoice = Invoice::findOrFail($invoice_id);
		   

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
		   
		   $attachment = 'public/pdfs/'.$invoice->invoice_id;   

		   $mail->AddAttachment($attachment);
		   $mail->Subject = $subject;
		   
		   $mail->Body = $body; 

		   if($mail->Send() ){
			   $today = date('Y-m-d', strtotime('now'));
			   DB::table('invoices')->where('id', $invoice->id )->update(array('sent_date' => $today ));	
			   $message_status = "success";
			   $message = "Sent Email";
		   } else {
		   		$message_status = "failed";
				$message = "Email failure. " . $mail->ErrorInfo;
		   }

		   $mail->ClearAllRecipients();

// }
	}

	


}

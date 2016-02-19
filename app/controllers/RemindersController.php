<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{

		// Password::remind(Input::only('email'), function($message)
		// {
		//     $message->subject('Password Reminder');
		//     return Redirect::back()->with('message');
		// });

		switch ($response = Password::remind(Input::only('email') ) )
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->with('status', Lang::get($response));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);


	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{

		

		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();

			Auth::login($user);
		});

		// return var_dump($response);

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
			// return "failed";
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:			
			// return "sucecss";
				return Redirect::to('/');
				return Redirect::to('login')->with('flash', 'Your password has been reset');
		}



		// // Get the request parameters
		// list( $email, $password, $password_confirmation) = Input::only('email', 'password', 'password_confirmation');

		// // Search for a user matching the email address
		// $user = User::where('email', $email)->first();

		// // Go ahead if a user matching that email was found
		// if ( ! is_null($user))
		// {
		//     // Check if the password and password confirmation match
		//     // NOTE: you can do additional validations here if needed
		//     if ($password == $passwordConfirmation)
		//     {
		//         $user->nome_completo = $name;
		//         $user->password = Hash::make($password);
		//         $user->save();

		//         return Redirect::to('/');
		//     }
		// }



		}

}

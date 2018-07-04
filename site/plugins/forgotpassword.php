<?php 

function forgotpassword () {

	$email = $_POST['email'];
	
	$token = bin2hex(openssl_random_pseudo_bytes(16));

	$user = db::select('users', 'id, firstname', array('email' => $email))->first();

	$link = url() . '/forgotpass/?token=' . $token;


	if (count($user)) {

	$message = "Hi {$user->firstname},\n
\n
You recently requested to reset the password for your account. Click the link below to reset it.\n
\n
{$link}\n
\n
If you didn't ask to change your password, you can just ignore this email or contact support if you have any questions.\n
\n
\n
Thanks,\n
\n
RPO Team";
	
		// search if this user already has a token and delete it
		db::delete('tokens', array('user_id' => $user->id));

		// add new token
		db::insert(
			'tokens',
			array(
				'user_id' => $user->id,
				'token' => $token
			)
		);

		$to = $email;
		$subject = "Forgot Password";
		$txt = $message;
		$headers = "From: no-reply" . "\r\n";

		mail($to,$subject,$txt,$headers);

		return response::success('Password changed!', array('success' => true));
	}
	else {
		return response::error("User not found!");
	}

}
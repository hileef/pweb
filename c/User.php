<?php

	require_once("./m/User.php");

	function say_hi() {
		echo("hello !");
	}

	function state() {
		$login = receive('login');
		$state = receive('state');

		if($state == NULL) view('user_2/state', state_get($login));
		else if($state > 0 && $state < 3) {
			state_set($login, $state);
			redirect_home();
		} else redirect_home();
	}

	function password() {
		require_once("./m/Sign.php");
		$login = receive('login');
		$oldpw = receive('oldpw');
		$newpw = receive('newpw');
		$cpypw = receive('cpypw');
		$errorMsg = "";

		if($oldpw == NULL || $newpw == NULL || $cpypw == NULL)
			view('user_2/password');
		else if(strcmp($newpw, $cpypw) != 0)
			view('user_2/password', "Sorry your new and confirmation password do not match.");
		else if(!checkSignInDB($login, $oldpw, $errorMsg))
			view('user_2/password', "Sorry wrong password.");
		else {
			password_set($login,$newpw);
			redirect_home();
		}
	}
?>


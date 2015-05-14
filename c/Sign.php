<?php
	
	require_once("./m/Sign.php");
	require_once('./m/User.php');

	function log_out() {
		state_set($_SESSION['login'],0);
		if(isset($_SESSION['login'])) unset($_SESSION['login']);
		if(isset($_SESSION['uid'])) unset($_SESSION['uid']);
		redirect_home();
	} 

	function log_redirect() {
		$val = receive('redirect');
		verror_on_null($val, 'no val provided');

		if($val == 'Log In') log_in();
		else if($val == 'Sign Up') sign_up();
		else verror('bad val provided');
	} 

	function sign_up(){
		$login = receive('login');
		$pwd = receive('pwd');
		$errorMsg = NULL;

		if($login == NULL || $pwd == NULL) view('sign');
		else if(checkUserInput($login,$pwd,$errorMsg) && checkSignUpDB($login,$errorMsg)) {
			if(!signUpDB($login,$pwd,$errorMsg)) view('sign');
			else redirect_home();
		} else view('sign');
	} 

	function log_in(){
		$login = receive('login');
		$pwd = receive('pwd');
		$errorMsg = NULL;

		if($login == NULL || $pwd == NULL) view('sign');
		else if(checkUserInput($login,$pwd,$errorMsg) && checkSignInDB($login,$pwd,$errorMsg)) {
			$_SESSION['login'] = $login;
			$_SESSION['uid'] = 	id_from_login($login);
			state_set($login,1);
			redirect_home();
		} else view('sign', $errorMsg);	

	} 

	function checkUserInput($login,$pwd,&$errorMsg) {
		if(isset($login) && isset($pwd)) return true;
		else {
			$errorMsg = "Please enter a Login or Password";
			return false;
		}
	}
?>
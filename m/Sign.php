<?php
	require_once("./m/db_core.php");

	function checkSignUpDB($login,&$errorMsg){
		$db = db_connect();
		$req = $db->prepare('SELECT login_user FROM User WHERE login_user = :login');
		$req->execute(array('login'=> $login));
		if($req->fetch()) {
			$errorMsg = "Fail to subscribe => ".$login." already exist";
			return false;
		} else return true;
	}


	function signUpDB($login,$pwd,&$errorMsg) {
		$db = db_connect();
		$req = $db->prepare('INSERT INTO User(login_user, pwd_user) VALUES(:login, :pwd)');
		if($req->execute(array('login'=>$login,'pwd'=>$pwd))) return true;
		else
		{
			$errorMsg = "Failed to insert ".$login." into the DB";
			return false;
		}
	}

	function checkSignInDB($login,$pwd,&$errorMsg) {
		$db = db_connect();
		$req = $db->prepare('SELECT login_user FROM User WHERE login_user = :login AND pwd_user = :pwd');
		$req->execute(array('login'=>$login,'pwd'=>$pwd));
		
		if($req->fetch()) return true;
		else
		{
			$errorMsg = "User/Password doesn't exist";
			return false;
		}	
	}
?>

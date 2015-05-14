<?php

	session_start();

	require_once('./r/sugar.php');

	$ulogin = receive('login');
	$uid = receive('uid');
	$not_logged_in = ($ulogin == NULL || $uid == NULL);

	$ctl = receive('ctl', "Discussion");
	$act = receive('act', "available");
	$not_reaching_sign_service =
		$ctl != 'Sign' && !($act == 'signIn' || $act == 'signUp');

	if($not_reaching_sign_service && $not_logged_in) view('sign');
	else { require_once("./c/" . $ctl . ".php"); $act(); }

?>

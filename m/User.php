<?php

	require_once("./m/db_core.php");

	function user_exists($uid) {
		$query = 'SELECT COUNT(id_user) FROM User WHERE id_user = :uid';
		return (db_request($query, array('uid'=>$uid), true) == 1);
	}

	function user_ary_full() {

		return db_request('SELECT * FROM User');
	}

	function user_ary($self_id) {

		$query = 'SELECT * FROM User WHERE id_user <> :uid';
		return db_request($query, array('uid' => $self_id));
	}

	function state_get($login) {

		$query = 'SELECT state_user FROM User WHERE login_user = :login';
		return db_request($query, array('login'=>$login), true);
	}

	function state_set($login, $stateValue) {

		$query = 'UPDATE User SET state_user = :state WHERE login_user = :login';
		db_request($query, array('login'=>$login,'state'=>$stateValue));
	}

	function id_from_login($login) {

		$query = 'SELECT id_user FROM User WHERE login_user = :login';
		return db_request($query, array('login'=>$login), true);
	}

	function login_from_id($id) {

		$query = 'SELECT login_user FROM User WHERE id_user = :id';
		return db_request($query, array('id'=>$id), true);
	}

	function password_set($login,$newPassword) {

		$query = 'UPDATE User SET pwd_user = :newPassword WHERE login_user = :login';
		db_request($query, array('login'=>$login,'newPassword'=>$newPassword));
	}

?>

<?php

	require_once("./m/Friend.php");

	function listing() {
		$result = friend_list_id(receive('uid'));
		$friendList = array();		
		foreach ($result as $l) {
			$friendList[] = array(login_from_id($l[0]),state_get(login_from_id($l[0])),$l[0], 'id_user' => $l[0]);			
		}				

		view('friend/listing', $friendList);
	}

	function remove() {
		$uid = receive('id');

		if($uid != NULL)
			friend_remove(receive('uid'), $uid);

		redirect('Friend', 'listing');
	}

	function add() {
		$uids = receive('uids');
		$login = receive('tlogin');

		if($uids == NULL && $login == NULL) 
			view('user_2/pick', 'Friend', 'add', friend_not_list(receive('uid')));
		else if($login != NULL) {
			$uid = id_from_login($login);
			if($uid == NULL)
				view('user_2/pick', 'Friend', 'add', friend_not_list(receive('uid')), 'did', 'Login does not exist.');
			else {
				friend_add(receive('uid'), $uid);
				redirect('Friend', 'listing');
			}
		} else if($uids != NULL) {
			foreach($uids as $uid) friend_add(receive('uid'), $uid);
			redirect('Friend', 'listing');
		}
	}

	

?>
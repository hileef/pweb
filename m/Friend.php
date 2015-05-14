<?php

	require_once("./m/db_core.php");
	require_once("./m/User.php");

	function friend_list_id($uid) {

		$query_one = 'SELECT id_friendB_FriendShip FROM Friendship WHERE id_friendA_Friendship= :uid';
		$ary_one = db_request($query_one, array('uid'=>$uid));
		$query_two = 'SELECT id_friendA_FriendShip FROM Friendship WHERE id_friendB_Friendship= :uid';
		$ary_two = db_request($query_two, array('uid'=>$uid));
		return array_merge($ary_one, $ary_two);
	}

	function friend_remove($uid_sm, $uid_lg) {
		swap_smaller_left($uid_sm, $uid_lg);

		$query = 'DELETE FROM Friendship WHERE id_friendA_Friendship = :uid_sm AND id_friendB_FriendShip = :uid_lg';
		db_request($query, array('uid_sm' => $uid_sm, 'uid_lg' => $uid_lg));		
	}

	function friend_exists($uid_sm, $uid_lg) {
		swap_smaller_left($uid_sm, $uid_lg);

		return in_array($uid_sm, fold(friend_list_id($uid_lg)));
	}

	function friend_add($uid_sm, $uid_lg) {
		swap_smaller_left($uid_sm, $uid_lg);

		if(friend_exists($uid_sm, $uid_lg))
		verror('friendship already exists.');

		$query = 'INSERT INTO Friendship(id_friendA_Friendship, id_friendB_FriendShip) VALUES (:uid_sm,:uid_lg)';
		db_request($query, array('uid_sm' => $uid_sm, 'uid_lg' => $uid_lg));
	}

	function swap_smaller_left(&$uid_1,&$uid_2) {
		if($uid_1 > $uid_2) {
			$tmp = $uid_1;
			$uid_1 = $uid_2;
			$uid_2 = $tmp;
		}
	}

	function friend_list($uid) {
		$all = user_ary($uid);
		$friends = fold(friend_list_id($uid));

		$list = array();
		foreach($all as $user) {
			if(in_array($user['id_user'], $friends))
				$list[] = $user;
		}

		return $list;
	}

	function friend_not_list($uid) {
		$all = user_ary($uid);
		$friends = fold(friend_list_id($uid));

		$list = array();
		foreach($all as $user) {
			if(!in_array($user['id_user'], $friends))
				$list[] = $user;
		}

		return $list;
	}

?>
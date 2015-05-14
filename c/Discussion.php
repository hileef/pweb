<?php
// Discussion controller

require_once("./m/User.php");
require_once("./m/Friend.php");
require_once("./m/Discussion.php");

function create() {
	$login = receive('tlogin');
	$uids = receive('uids');
	$self_id = receive('uid');
	verror_on_null($self_id, "self_uid required");

	if($uids == NULL && $login == NULL)
		view('user_2/pick', 'Discussion', 'create', friend_list($self_id));
	else if($login != NULL) {
		$uid = id_from_login($login);
		if($uid == NULL)
			view('user_2/pick', 'Discussion', 'create', friend_list($self_id), 'did', 'Login does not exist.');
		else {
			add_disc($self_id, array(id_from_login($login)));
			redirect('Discussion', 'available');
		}
	} else if($uids != NULL) { 
		add_disc($self_id, $uids);
		redirect('Discussion', 'available');
	}
}

function available() {
	$self_id = receive('uid');
	verror_on_null($self_id, "self_uid required");

	view('disc/available', translate_to_users(disc_ary_for_user($self_id)));
}

function display() {
	$did = receive('did');
	verror_on_null($did, "error no disc_id provided");

	view('disc/display', user_ary_in_disc($did), msg_ary_in_disc($did), $did);
}

function push() {

	$did = receive('did');
	$payload = receive('payload');
	$self_uid = receive('uid');
	verror_on_null($did, "no disc_id provided");
	verror_on_null($payload, "no payload provided");
	verror_on_null($self_uid, "no self_uid provided");

	push_message_to_disc($did, $payload, $self_uid);
	redirect('Discussion', 'display&did=' . $did);
}

function add() {
	$login = receive('tlogin');
	$uids = receive('uids');
	$did = receive('did');
	verror_on_null($did, "error no disc_id provided");

	if($uids == NULL && $login == NULL)
		view('user_2/pick', 'Discussion', 'add', friend_ary_not_in_disc($did), $did);
	else if($login != NULL) {
		$uid = id_from_login($login);
		if($uid == NULL)
			view('user_2/pick', 'Discussion', 'add', friend_ary_not_in_disc($did), $did, 'Login does not exist.');
		else {
			add_user_to_disc($did, array($uid));
			redirect('Discussion', 'display&did=' . $did);
		}
	} else if($uids != NULL) {
		add_user_to_disc($did, $uids);
		redirect('Discussion', 'display&did=' . $did);
	}
}

function remove() {
	$login = receive('tlogin');
	$uids = receive('uids');
	$did = receive('did');
	verror_on_null($did, "error no disc_id provided");

	if($uids == NULL && $login == NULL)
		view('user_2/pick', 'Discussion', 'remove', user_ary_in_disc($did), $did);
	else if($login != NULL) {
		$uid = id_from_login($login);
		if($uid == NULL)
			view('user_2/pick', 'Discussion', 'remove', user_ary_in_disc($did), $did, 'Login does not exist.');
		else {
			remove_user_from_disc($did, array($uid));
			redirect('Discussion', 'display&did=' . $did);
		}
	} else if($uids != NULL) {
		remove_user_from_disc($did, $uids);
		redirect('Discussion', 'display&did=' . $did);
	}
}

function drop() {
	$did = receive('did');
	verror_on_null($did, "error no disc_id provided");

	drop_disc($did);
	redirect_home();
}

function leave() {

	$did = receive('did');
	$self_uid = receive('uid');
	verror_on_null($did, "error no disc_id provided");
	verror_on_null($self_uid, "no self_uid provided");

	remove_user_from_disc($did, array($self_uid));
	redirect('Discussion', 'available');
}

?>



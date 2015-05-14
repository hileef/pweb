<?php
// Discussion model

require_once('db_core.php');
require_once('./m/User.php');

function disc_ary_for_user($self_uid) {
	verify_user($self_uid);

	$query = 'SELECT DISTINCT id_discussion FROM Discussion WHERE user_in_discussion = :uid';
	return db_request($query, array('uid'=>$self_uid));
}

function translate_to_users($disc_ary) {
	$repp = array();
	foreach ($disc_ary as $disc) {
		$rep = array();
		$rep[0] = $disc[0];
		$rep['usr_ary'] = user_ary_in_disc($disc[0]);
		$repp[] = $rep;
	}
	return $repp;
}

function push_message_to_disc($did, $payload, $self_uid) {
	verify_disc($did);
	verify_user($self_uid);
	verror_on_null($payload, "no payload provided for message");

	$query = 'INSERT INTO Message(id_sender_message, id_discussion_message, payload_message) VALUES(:uid, :did, :payload)';
	db_request($query, array('uid' => $self_uid, 'did' => $did, 'payload' => $payload));
}

function msg_ary_in_disc($did) {
	verify_disc($did);

	$query = 'SELECT id_sender_message, payload_message, timestamp_message, login_user
				FROM Message, User WHERE id_user = id_sender_message AND id_discussion_message = :did
				ORDER BY timestamp_message ASC';
	return db_request($query, array('did' => $did));
}

function user_id_ary_in_disc($did) {
	verify_disc($did);

	$query = ('SELECT user_in_discussion FROM Discussion WHERE id_discussion = :did');
	return db_request($query, array('did' => $did));
}

function user_ary_in_disc($id) {

	$ary = user_ary_full();
	$disc = fold(user_id_ary_in_disc($id));

	// $disc = array();
	// foreach($discs as $d) $disc[] = $d[0];

	$rep = array();
	foreach($ary as $usr) 
		if(in_array($usr['id_user'], $disc))
			$rep[] = $usr;

	return $rep;
}

function user_ary_not_in_disc($id) {

	$ary = user_ary_full();
	$discs = user_id_ary_in_disc($id);

	$disc = array();
	foreach($discs as $d) $disc[] = $d[0];

	$rep = array();
	foreach($ary as $usr)
		if(!in_array($usr['id_user'], $disc))
			$rep[] = $usr;

	return $rep;
}

function friend_ary_not_in_disc($id) {

	$ary = friend_list();
	$discs = user_id_ary_in_disc($id);

	$disc = array();
	foreach($discs as $d) $disc[] = $d[0];

	$rep = array();
	foreach($ary as $usr)
		if(!in_array($usr['id_user'], $disc))
			$rep[] = $usr;

	return $rep;

}

function add_disc($self_uid, $usr_ary) {
	verify_user($self_uid);

	$newid = get_next_free_id();

	$query = 'INSERT INTO Discussion(id_discussion, User_in_discussion) VALUES(:did, :uid)';
	db_request($query, array('did' => $newid, 'uid' => $self_uid));

	return add_user_to_disc($newid, $usr_ary);
}

function add_user_to_disc($did, $usr_ary) {
	verify_disc($did);
	verify_users($usr_ary);

	$query = 'INSERT INTO Discussion(id_discussion, user_in_discussion) VALUES(:did, :uid)';

	foreach($usr_ary as $uid)
		db_request($query, array('did' => $did,'uid' => $uid));
	
	return $did;
}

function remove_user_from_disc($did, $usr_ary) {
	verify_disc($did);
	verify_users($usr_ary);

	$query = 'DELETE FROM Discussion WHERE id_discussion = :did AND user_in_discussion = :uid';

	foreach($usr_ary as $uid)
		db_request($query, array('uid' => $uid, 'did' => $did));
}

function drop_disc($did) {
	verify_disc($did);

	db_request('DELETE FROM Discussion WHERE id_discussion = :did', array('did'=> $did));
	verror("WARNING : Discussion has been dropped BUT, associated messages need to be removed.");
}

function get_next_free_id() {

	$maxid = db_request('SELECT MAX(id_discussion) FROM Discussion', NULL, true);
	return ($maxid == NULL) ? 1 : $maxid + 1;
}

function verify_user($uid) {
	
	if(!user_exists($uid))
	verror("usr provided does not exist.");
}

function verify_users($usr_ary) {

	if($usr_ary == NULL or count($usr_ary) == 0)
		verror("usr_ary provided is null or empty.");

	foreach($usr_ary as $uid)
		verify_user($uid);
}

function verify_disc($id) {

	if(!(db_request('SELECT COUNT(id_discussion) FROM Discussion WHERE id_discussion = :did', array('did'=>$id), true) > 0))
		verror('Discussion with id ' . $id . ' does not exist.');
}

?>

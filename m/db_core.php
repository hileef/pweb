<?php
// core database data and methods

global $db_host, $db_user, $db_pswd, $db_name;

$db_host = "127.0.0.1";
$db_user = "hautefeu";
$db_pswd = "hautefeu";
$db_name = "pweb_hautefeu";

function db_connect() {

	global $db_host, $db_user, $db_pswd, $db_name;
	$link = 'mysql:host=' . $db_host . ';dbname=' . $db_name;

	try { return new PDO($link, $db_user, $db_pswd); }
	catch(Exception $e) { verror($e->getMessage()); }
}

function db_request($query, $params = NULL, $singular = false){

	$db = db_connect();

	if($params == NULL) $req = $db->query($query);
	else {
		$req = $db->prepare($query);
		$req->execute($params);
	}

	if($singular) { $response = $req->fetch()[0]; }
	else {
		if(!$req) { $response = NULL; }
		else { $response = $req->fetchAll(); }
	}

	$req->closeCursor();

	return $response;
}

?>

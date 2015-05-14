<?php
// this file contains syntactic sugar simplifications

function receive($rec_index, $rec_default = NULL) {
	$rec = (isset($_GET[$rec_index])) ? $_GET[$rec_index] : $rec_default;
	$rec = (isset($_POST[$rec_index])) ? $_POST[$rec_index] : $rec;
	$rec = (isset($_SESSION[$rec_index])) ? $_SESSION[$rec_index] : $rec;
	return $rec;
} 

function redirect($ctl, $act) {
	header('Location: ' . '?ctl=' . $ctl . '&act=' . $act);
}

function redirect_home() {
	header('Location: ?');
}

function verror($error = "Fatal error encountered.") {
	view('core/error', $error);
	die();
}

function verror_on_null($val, $error) {
	if($val == NULL) verror($error);
}

function view($view) {
	$args = func_get_args();
	if($view == 'sign')
		require_once('./v/core/sign.tpl');
	else {
		require_once('./v/core/header.tpl');
		require_once('./v/' . $view . '.tpl');
		require_once('./v/core/footer.tpl');
	}
}

function fold($ary_in2d, $i = 0) {
	$folded = array();
	foreach($ary_in2d as $d)
		$folded[] = $d[$i];
	return $folded;
}

?>

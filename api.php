<?php

function require_auth() {
	$AUTH_USER = 'wind.interactive';
	$AUTH_PASS = 'wind.interactive';
	header('Cache-Control: no-cache, must-revalidate, max-age=0');
	$has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
	$is_not_authenticated = (
		!$has_supplied_credentials ||
		$_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
		$_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
	);
	if ($is_not_authenticated) {
		header('HTTP/1.1 401 Authorization Required');
		header('WWW-Authenticate: Basic realm="Access denied"');
		die("You need enter password");
		exit;
	}
}

require_auth();

$jsonFile = fopen("adv.json", "w") or die("Unable to open file!");
fwrite($jsonFile, file_get_contents('php://input'));
fclose($jsonFile);

<?php
session_start();
gourl("登出成功","index.php");
function gourl( $test, $url ) {
	$_SESSION[ 'alert' ] = $test;
	header( 'location:' . $url );
	exit;
}
?>
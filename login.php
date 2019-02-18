<?php
session_start();
$account = $_POST[ 'account' ];
$password = $_POST[ 'password' ];
$ccach = $_POST[ 'cach' ];
$scach = $_SESSION[ 'math' ];
if ( ++$_SESSION[ 'times' ] > 2 ) {
	if ( $account == "admin" ) {
		if ( $password == "1234" ) {
			if ( $ccach == $scach ) {
				gourl( "第二層驗證碼", "cach2.php" );
			}
		}
	}
	$_SESSION[ 'times' ] = 0;
	gourl( "錯誤超過三次", "loginlose.php" );
}
if ( $account == "admin" ) {
	if ( $password == "1234" ) {
		if ( $ccach == $scach ) {
			gourl( "第二層驗證碼", "cach2.php" );
		} else {
			gourl( "驗證碼錯誤", "index.php" );
		}
	} else {
		gourl( "帳號密碼錯誤", "index.php" );
	}
} else {
	gourl( "帳號密碼錯誤", "index.php" );
}

function gourl( $test, $url ) {
	$_SESSION[ 'alert' ] = $test;
	header( 'location:' . $url );
	exit;
}
?>
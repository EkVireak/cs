<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$urii = 'https://';
	} else {
		$urii = 'http://';
	}
	$urii .= $_SERVER['HTTP_HOST']."/cs";

	session_start();
	// $_SESSION['userlogin'] = 'bongvireak';

	DEFINE('BASE_URL', $urii );
	DEFINE('BASE_PATH', __DIR__ );
	DEFINE('AJAX_URL', BASE_URL.'/functions/ajax' );

	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'cs');
	DEFINE('DB_USER', 'root');
	DEFINE('DB_PASS', '');


	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	date_default_timezone_set('Asia/Bangkok');

	$today_date = date('Y-m-d H:i:s');

	$today_timestamp = strtotime($today_date);

	require_once(BASE_PATH.'/functions/functions.php');

// var_dump(strtotime('2018-09-03 23:37:01'));
// echo '<br>';
// var_dump(date( 'D, d M Y H:i:s' ));


// var_dump(date('d', strtotime('2018-09-03')));
// var_dump(date('m', strtotime('2018-09-03')));
// var_dump(date('Y', strtotime('2018-09-03')));

// var_dump(time());



// var_dump(strtotime('2018-09-03 23:37:01'));
// echo '<br>';
// var_dump(date('Y-m-d H:i:s', 1535992621));

	function get_avatar(){
		if( isset($_SESSION['userlogin']) && is_array($_SESSION['userlogin']) ){
			if( file_exists(BASE_PATH.'/users/'.$_SESSION['userlogin']['username'].'/'.$_SESSION['userlogin']['avatar']) )
				return '<img src="'.BASE_URL.'/users/'.$_SESSION['userlogin']['username'].'/'.$_SESSION['userlogin']['avatar'].'">';
			else
				return '<img src="'.BASE_URL.'/assets/img/avatar.png">';
		}
		else
			return '<img src="'.BASE_URL.'/assets/img/avatar.png">';
	}
	function get_user_avatar($username, $avatar){
		if( file_exists(BASE_PATH.'/users/'.$username.'/'.$avatar) )
			return '<img src="'.BASE_URL.'/users/'.$username.'/'.$avatar.'">';
		else
			return '<img src="'.BASE_URL.'/assets/img/avatar.png">';
	}
	function format_ago($ago){
		if( $ago >= 60 ){
			if( $ago >= 60*60 ){
				if( $ago >= 24*60*60 ){
					return number_format($ago/60/60/24).'day';
				}
				else
					return number_format($ago/60/60).'hour';
			}
			else
				return number_format($ago/60).'min';
		}
		else
			return number_format($ago).'second';
	}
<?php
	if( isset($_SESSION['userlogin']) ){
	$user_login = get_user_login_data($_SESSION['userlogin']['id'], $conn);
	// var_dump($user_login);
	//header

	$user_login['setting'] = get_user_login_setting($user_login['username']);


	}



















	require_once(BASE_PATH.'/views/parts/header.php');

	// body
	$uri = substr(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), 3);

	if( ($uri == "" || $uri == "/") && !isset($_GET['anonymous']) ){
		if( !isset($_SESSION['userlogin']) ){
			header('location:'.BASE_URL.'/login');
		}
		else{
			require_once(BASE_PATH.'/views/parts/navbar.php');
			require_once(BASE_PATH.'/views/pages/comment/comment.php');
		}
	}
	elseif( $uri == '/login' || $uri == '/login/'){
		if( isset($_SESSION['userlogin']) ){
			header('location:'.BASE_URL);
		}
		else{
			require_once(BASE_PATH.'/views/pages/login/login.php');
		}
	}
	elseif( $uri == '/register' || $uri == '/register/'){
		if( isset($_SESSION['userlogin']) ){
			header('location:'.BASE_URL);
		}
		else{
			require_once(BASE_PATH.'/views/pages/register/register.php');
		}
	}
	elseif( $uri == '/profile' || $uri == '/profile/'){
		if( !isset($_SESSION['userlogin']) ){
			header('location:'.BASE_URL.'/login');
		}
		else{
			require_once(BASE_PATH.'/views/parts/navbar.php');
			require_once(BASE_PATH.'/views/pages/profile/profile.php');
		}
	}
	else{

		if( isset($_GET['anonymous']) ){
			require_once(BASE_PATH.'/views/parts/navbar.php');
			require_once(BASE_PATH.'/views/pages/comment/comment.php');
		}
		else
			require_once(BASE_PATH.'/views/pages/404/404.php');
	}
	
	// footer
	require_once(BASE_PATH.'/views/parts/footer.php');

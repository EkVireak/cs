<?php

	require_once('cs-config.php');
	require_once(BASE_PATH.'/views/index.php');

// var_dump(BASE_PATH);
// var_dump(BASE_URL);

// var_dump($_SERVER['REQUEST_URI']);
// echo '<br>';
// var_dump($_SERVER['SERVER_NAME']);
// echo '<br>';
// var_dump($_SERVER['PHP_SELF']);
// echo '<br>';
// $jj = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
// var_dump($jj);

// session_start();
// $_SESSION['username'] = null;
// $_SESSION['asdf'] = null;
// // // session_destroy();

// if( !session_id() != '' || !isset($_SESSION['username']) ){
// 	header('location:'.BASE_URL.'/login');
// }
// else{
// 	echo 'no session';
// }
// session_destroy();

// var_dump(session_id());





$sql = "SELECT comment_id, comment_text, like_count, reply_count, comments.date_created as comment_date_created, comments.date_updated as comment_date_updated, users.avatar, users.username, users.user_id, users.date_created as users_date_created FROM comments INNER JOIN users ON comments.user_id = users.user_id";
$row_selected = $conn->query($sql);
// if( $row_selected === TRUE ) {
	// if( $row_selected->num_rows > 0 ){
	// 	while($row = $row_selected->fetch_assoc()) {
	// 		var_dump($row);
	// 		if($row['username'] == 'v')
	// 			echo 'yes';
	// 	}
	// }
	// else
	// 	echo 'no row';
// }
// else{
// 	echo  $conn->error;
// }


	$sql_reply = "SELECT reply_id, comment_id, replies.user_id as user_id, reply_text, replies.date_created as reply_date_created, replies.date_updated as reply_date_updated, users.avatar, users.username FROM replies INNER JOIN users ON replies.user_id = users.user_id";
	$reply_selected = $conn->query($sql_reply);

	// if( $reply_selected->num_rows > 0 ){
	// 	while($row = $row_selected->fetch_assoc()) {
	// 		var_dump($row);
	// 		if($row['username'] == 'v')
	// 			echo 'yes';
	// 	}
	// }
	// else
	// 	echo 'no row';
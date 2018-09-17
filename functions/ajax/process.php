<?php
	if ( file_exists(dirname(dirname(__DIR__)) . '/cs-config.php') ){
		require_once( dirname(dirname(__DIR__)) . '/cs-config.php' );
	}
	else{
		echo json_encode( dirname(dirname(__DIR__)) );
		die();
	}
	

	$data = array();

	if( isset($_POST['action']) ){
		$action = $_POST['action'];

		if( $action == 'comment'){
			if( isset($_POST['comment_text']) && isset($_POST['user_id']) && !empty($_POST['comment_text']) && !empty($_POST['user_id']) ){
				
				$user_id = $_POST['user_id'];
				$comment_text = $_POST['comment_text'];

				$sql = "INSERT INTO comments( comment_text, user_id ) VALUES('$comment_text', $user_id)";
				if ($conn->query($sql) === TRUE) {
					$data['success'] = true;
					$data['redirect'] = BASE_URL;
				}
				else {
					$data['success'] = false;
				    $data['error'] = "Error updating record: " . $conn->error;
				    $data['sql'] = $sql;
				}
				
			}
			else{
				$data['error'] = 'Data !isset';
			}
		}
		elseif( $action == 'reply' ){
			if( isset($_POST['reply_text']) && isset($_POST['user_id']) && isset($_POST['comment_id']) && !empty($_POST['reply_text']) && !empty($_POST['user_id']) && !empty($_POST['comment_id']) ){
				
				$user_id = $_POST['user_id'];
				$comment_id = $_POST['comment_id'];
				$reply_text = $_POST['reply_text'];

				$inserting = $today_timestamp;
				$sql = "INSERT INTO replies( comment_id, user_id, reply_text ) VALUES($comment_id, $user_id, '$reply_text')";
				if ($conn->query($sql) === TRUE) {

					$reply_count_sql = "SELECT COUNT(*) FROM replies WHERE comment_id=$comment_id";
					$reply_count_row = $conn->query($reply_count_sql);


					if( $reply_count_row->num_rows > 0  ){
						while( $row = $reply_count_row->fetch_assoc() ){
							$data['reply_count'] = (int)$row['COUNT(*)'];
						}
						$data['success'] = true;
						$data['redirect'] = BASE_URL;
					}
					else{
						$data['success'] = false;
					    $data['error'] = "Error inserting record";
					}
				}
				else {
					$data['success'] = false;
				    $data['error'] = "Error updating record: " . $conn->error;
				}
				
			}
			else{
				$data['error'] = 'Data !isset';
			}
		}
		elseif( $action == 'like' ){
			if( isset($_POST['user_id']) && isset($_POST['comment_id']) && !empty($_POST['user_id']) && !empty($_POST['comment_id']) ){

				$user_id = $_POST['user_id'];
				$comment_id = $_POST['comment_id'];

				$select_sql = "SELECT * FROM likes WHERE comment_id=$comment_id AND user_id=$user_id";
				$select_sql_row = $conn->query($select_sql);

				if( $select_sql_row->num_rows > 0  ){

					$delete_sql = "DELETE FROM likes WHERE comment_id=$comment_id AND user_id=$user_id";

					if ($conn->query($delete_sql) === TRUE) {

						$select_sql = "SELECT COUNT(*) FROM likes WHERE comment_id=$comment_id";
						$select_sql_row = $conn->query($select_sql);

						if( $select_sql_row->num_rows > 0  ){
							while( $row = $select_sql_row->fetch_assoc() ){
								$data['like_count'] = (int)$row['COUNT(*)'];
							}
							$data['success'] = true;
							$data['like'] = false;
							$data['redirect'] = BASE_URL;
						}

					}
					else {
						$data['success'] = false;
					    $data['error'] = "Error updating record: " . $conn->error;
					}
				}
				else{
					$insert_sql = "INSERT INTO likes( comment_id, user_id ) VALUES($comment_id, $user_id)";
					if ($conn->query($insert_sql) === TRUE) {
						$select_sql = "SELECT COUNT(*) FROM likes WHERE comment_id=$comment_id";
						$select_sql_row = $conn->query($select_sql);

						if( $select_sql_row->num_rows > 0  ){
							while( $row = $select_sql_row->fetch_assoc() ){
								$data['like_count'] = (int)$row['COUNT(*)'];
							}
							$data['success'] = true;
							$data['like'] = true;
							$data['redirect'] = BASE_URL;
						}

					}
					else {
						$data['success'] = false;
					    $data['error'] = "Error updating record: " . $conn->error;
					    $data['sql'] = $sql;
					}
				}
			}
			else{
				$data['error'] = 'data !isset';
			}
		}
		elseif( $action == 'who_like' ){
			if( isset($_POST['user_id']) && isset($_POST['comment_id']) && !empty($_POST['user_id']) && !empty($_POST['comment_id']) ){

				$user_id = $_POST['user_id'];
				$comment_id = $_POST['comment_id'];

				$select_sql = "SELECT comment_id, user_id FROM likes WHERE comment_id=$comment_id";
				$select_sql_row = $conn->query($select_sql);

				if( $select_sql_row->num_rows > 0  ){
					$data['who_like'] = array();
					$i = 0;
					while( $row = $select_sql_row->fetch_assoc() ){
						$data['who_like'][$i] = $row;
						$i++;
					}
					$data['success'] = true;
					$data['redirect'] = BASE_URL;
				}
				else{
					$data['error'] = 'sql error';
				}
			}
			else{
				$data['error'] = 'data error';
			}
		}
		elseif( $action == "user_setting" ){
			if( isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['background']) && !empty($_POST['background']) ){

				$json = '{"background":"'.$_POST['background'].'"}';
				$user = $_POST['username'];
				set_user_login_setting($user, $json);

				$data['success'] = true;
				$data['redirect'] = BASE_URL;
			}
			else{
				$data['error'] = 'data error';
			}
		}
		else{
			$data['error'] = 'action error';
		}//action
	}
	else{
		$data['error'] = 'action !isset';
	}
	echo json_encode($data);
<?php
	if ( file_exists(dirname(dirname(__DIR__)) . '/cs-config.php') ){
		require_once( dirname(dirname(__DIR__)) . '/cs-config.php' );
	}
	else{
		echo json_encode( dirname(dirname(__DIR__)) );
		die();
	}
	

	$data = array();
	$date = date('y-m-d h:m:s');

	if( isset($_POST['action']) ){
		$action = $_POST['action'];

		if( $action == 'handle_like'){
			if( isset($_POST['comment_id']) && !empty($_POST['comment_id']) ){
				$comment_id = $_POST['comment_id'];
				$select_sql = "SELECT COUNT(*) FROM likes WHERE comment_id=$comment_id";
				$select_sql_row = $conn->query($select_sql);
				if( $select_sql_row->num_rows > 0 ){
					while( $row = $select_sql_row->fetch_assoc() ){
						$data['success'] = true;
						$data['like_count'] = $row['COUNT(*)'];
					}
				}
			}
			else{
				$data['error'] = 'Data error';
			}
		}
		elseif( $action == 'reply' ){

		}
		elseif( $action == 'like' ){

		}
		elseif( $action == 'who_like' ){
			
		}
		else{
			$data['error'] = 'action error';
		}//action
	}
	else{
		$data['error'] = 'action !isset';
	}
	echo json_encode($data);
<?php
	
	function get_user_login_data($user_id, $conn){
		$sql = "SELECT user_id, username, email, firstname, lastname, gender, birthday, avatar FROM users WHERE user_id = $user_id";
		$result = $conn->query($sql);
		if( $result->num_rows > 0 ){
			while( $row = $result->fetch_assoc() ){
				return $row;
			}
		}
		else{
			return false;
		}
	}
	function get_user_login_setting($username){
		$setting_json = BASE_PATH.'/users/'.$username.'/setting.json';
		$file = fopen( $setting_json, 'r' );
		$read = fread( $file, filesize($setting_json) );
		fclose($file);
		return json_decode($read);
	}
	function set_user_login_setting( $username, $data ){
		$setting_json = BASE_PATH.'/users/'.$username.'/setting.json';
		$file = fopen( $setting_json, 'w' );
		fwrite($file, $data);
		fclose($file);
	}
	function format_month($month=1){
		if( $month == 1 )
			return "january";
		elseif( $month == 2 )
			return "February";
		elseif( $month == 3 )
			return "March";
		elseif( $month == 4 )
			return "April";
		elseif( $month == 5 )
			return "May";
		elseif( $month == 6 )
			return "June";
		elseif( $month == 7 )
			return "July";
		elseif( $month == 8 )
			return "August";
		elseif( $month == 9 )
			return "September";
		elseif( $month == 10 )
			return "October";
		elseif( $month == 11 )
			return "November";
		elseif( $month == 12 )
			return "December";
	}
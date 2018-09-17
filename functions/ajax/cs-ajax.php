<?php
	if ( file_exists(dirname(dirname(__DIR__)) . '/cs-config.php') ){
		require_once( dirname(dirname(__DIR__)) . '/cs-config.php' );
	}
	else{
		echo json_encode( dirname(dirname(__DIR__)) );
		die();
	}
	
	function check_user_data($user_data){

		$firstname_error = false;
		$lastname_error = false;
		$birth_day_error = false;
		$birth_month_error = false;
		$birth_year_error = false;
		$gender_error = false;

		if( strlen($user_data['firstname']) >= 50 ){
			$firstname_error = true;
			$data['error']['firstname'] = 'Name too long';
		}
		if( strlen($user_data['lastname']) >= 50 ){
			$lastname_error = true;
			$data['error']['lastname'] = 'Name too long';
		}
		if( strlen($user_data['gender']) >= 10 ){
			$gender_error = true;
			$data['error']['gender'] = 'Name too long';
		}
		if( $user_data['birth_day'] < 1 || $user_data['birth_day'] > 31 ){
			$birth_day_error = true;
			$data['error']['birth_day'] = 'Day error';
		}
		if( $user_data['birth_month'] < 1 || $user_data['birth_month'] > 12 ){
			$birth_month_error = true;
			$data['error']['birth_month'] = 'Month error';
		}
		if( $user_data['birth_year'] < 1900 || $user_data['birth_year'] > 2018 ){
			$birth_year_error = true;
			$data['error']['birth_year'] = 'Year error';
		}

		if( $firstname_error || $lastname_error || $birth_day_error || $birth_month_error || $birth_year_error || $gender_error ){
			return false;
		}
		else
			return true;
	}

	function check_account_data($account_data){

		$username_error = false;
		$email_error = false;
		$password_error = false;
		$cpassword_error = false;
		$accept_term_error = false;
		$gender_error = false;

		if( strlen($account_data['username']) >= 25 ){
			$username_error = true;
			$data['error']['username'] = 'Username error';
		}
		if( strlen($account_data['email']) >= 50 ){
			$email_error = true;
			$data['error']['email'] = 'Email error';
		}
		if( strlen($account_data['password']) >= 50 ){
			$password_error = true;
			$data['error']['password'] = 'Password error';
		}
		if( $account_data['cpassword'] !=  $account_data['password'] ){
			$cpassword_error = true;
			$data['error']['cpassword'] = 'Confrim Passowrd error';
		}
		if( !$account_data['accept_term'] ){
			$accept_term_error = true;
			$data['error']['accept_term'] = 'Accept term error';
		}

		if( $username_error || $email_error || $password_error || $cpassword_error || $accept_term_error ){
			return false;
		}
		else
			return true;
	}

	function md5_encrypt($string){
		return md5($string);
	}

	$data = array();
	$date = date('y-m-d h:m:s');
	if( isset($_POST['action']) ){
		$action = $_POST['action'];

		if( $action == 'edit-profile'){
			if( isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birth-day']) && isset($_POST['birth-month']) && isset($_POST['birth-year']) && isset($_POST['gender']) ){
				if( !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['birth-day']) && !empty($_POST['birth-month']) && !empty($_POST['birth-year']) && !empty($_POST['gender']) ){
					$user_data = array(
						'firstname' => $_POST['firstname'],
						'lastname' => $_POST['lastname'],
						'birth_day' => (int)$_POST['birth-day'],
						'birth_month' => (int)$_POST['birth-month'],
						'birth_year' => (int)$_POST['birth-year'],
						'gender' => $_POST['gender']
					);
					if( !check_user_data($user_data) ){
						$data['success'] = false;
					}
					else{

						$sql = "UPDATE users SET firstname='".$user_data['firstname']."', lastname='".$user_data['lastname']."',birthday='".$user_data['birth_year']."-".$user_data['birth_month']."-".$user_data['birth_day']."', gender='".$user_data['gender']."', date_updated='$date' WHERE user_id=".$_SESSION['userlogin']['id'];
						if ($conn->query($sql) === TRUE) {
						    $data['success'] = true;
						    $data['user'] = $user_data;
						}
						else {
							$data['success'] = false;
						    $data['error'] = "Error updating record: " . $conn->error;
						}
					}
				}
				else{
					$data['error'] = array();
					if( empty($_POST['firstname']) )
						$data['error']['firstname'] = 'Firstname empty';
					if(  empty($_POST['lastname']) )
						$data['error']['lastname'] = 'Lastname empty';
					if(  empty($_POST['birth-day']) )
						$data['error']['birth-day'] = 'Birth Day empty';
					if( empty($_POST['birth-month']) )
						$data['error']['birth-month'] = 'Birth Month empty';
					if( empty($_POST['birth-year']) )
						$data['error']['birth-year'] = 'Birth Year empty';
					if( empty($_POST['gender']) )
						$data['error']['gender'] = 'Gender empty';
				}
			}
			else{
				$data['error'] = 'Data !isset';
			}
		}
		elseif( $action == 'login' ){
			if( isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']) ){

				$username = $_POST['username'];
				$password = md5_encrypt($_POST['password']);

				$sql = "SELECT user_id, avatar FROM users WHERE username='$username' AND password='$password'";
				$row_username = $conn->query($sql);

				if( $row_username->num_rows > 0 ){
					while( $row = $row_username->fetch_assoc() ){
						$_SESSION['userlogin'] = array();
						$_SESSION['userlogin']['id'] = $row['user_id'];
						$_SESSION['userlogin']['avatar'] = $row['avatar'];
						$_SESSION['userlogin']['username'] = $username;
						$data['success'] = true;
						$data['redirect'] = BASE_URL;
					}
				}
				else{
					$data['success'] = false;
					$data['error']['login'] = 'Incorrect username or password';
				}

			}
			else{
				$data['error'] = 'Data error';
			}
		}
		elseif( $action == 'register' ){
			if( isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birth-day']) && isset($_POST['birth-month']) && isset($_POST['birth-year']) && isset($_POST['gender']) ){
				if( !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['birth-day']) && !empty($_POST['birth-month']) && !empty($_POST['birth-year']) && !empty($_POST['gender']) ){

					$user_data = array(
						'firstname' 	=> $_POST['firstname'],
						'lastname' 		=> $_POST['lastname'],
						'birth_day' 	=> (int)$_POST['birth-day'],
						'birth_month' 	=> (int)$_POST['birth-month'],
						'birth_year' 	=> (int)$_POST['birth-year'],
						'gender' 		=> $_POST['gender']
					);
					if( !check_user_data($user_data) ){
						$data['success'] = false;
					}
					else{
						$account_data = array(
							'username' 		=> $_POST['username'],
							'password' 		=> $_POST['password'],
							'cpassword' 	=> $_POST['cpassword'],
							'email' 		=> $_POST['email'],
							'accept_term' 	=> $_POST['accept-term']
						);
						if( !check_account_data($account_data) ){
							$data['success'] = false;
						}
						else{
							$username_error = false;
							$email_error = false;

							$sql = "SELECT username FROM users WHERE username='".$account_data['username']."'";
							$row_username = $conn->query($sql);

							if( $row_username->num_rows > 0 ){
								$data['error']['username'] = 'Username already used';
								$username_error = true;
							}

							$sql = "SELECT email FROM users WHERE email='".$account_data['email']."'";
							$row_email = $conn->query($sql);

							if( $row_email->num_rows > 0  ){
								$data['error']['email'] = 'Email already used';
								$email_error = true;
							}

							if( $username_error || $email_error ){
								$data['success'] = false;
							}
							else{
								$sql = "INSERT INTO 
								users( username, password, email, firstname, lastname, gender, birthday, role, active, term_accept ) 
								VALUES( '".$account_data['username']."', '".md5_encrypt($account_data['password'])."', '".$account_data['email']."', '".$user_data['firstname']."', '".$user_data['lastname']."', '".$user_data['gender']."', '".$user_data['birth_year']."-".$user_data['birth_month']."-".$user_data['birth_day']."', 'user', 1, 1)";
								if ($conn->query($sql) === TRUE) {
								    
									if( !isset($_SESSION['userlogin']) ){
										$_SESSION['userlogin'] = $username;
										$data['success'] = true;
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
					}
				}
				else{
					$data['error'] = array();
					if( empty($_POST['firstname']) )
						$data['error']['firstname'] = 'Firstname empty';
					if(  empty($_POST['lastname']) )
						$data['error']['lastname'] = 'Lastname empty';
					if(  empty($_POST['birth-day']) )
						$data['error']['birth-day'] = 'Birth Day empty';
					if( empty($_POST['birth-month']) )
						$data['error']['birth-month'] = 'Birth Month empty';
					if( empty($_POST['birth-year']) )
						$data['error']['birth-year'] = 'Birth Year empty';
					if( empty($_POST['gender']) )
						$data['error']['gender'] = 'Gender empty';
				}
			}
			else{
				$data['error'] = 'Data !isset';
			}
		}
		else if( $action == 'logout'){
			session_destroy();
			$data['success'] = true;
			$data['redirect'] = BASE_URL;
			
			// if( isset($_SESSION['userlogin']) ){
			// 	$_SESSION['userlogin'] = null;
			// }
			// else{
			// 	$data['success'] = false;
			// }
		}
		else{
			$data['error'] = 'action error';
		}//action
	}
	else{
		$data['error'] = 'action !isset';
	}
	echo json_encode($data);
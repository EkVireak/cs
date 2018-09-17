	
	<div class="container" style="padding-top: 120px;">
		<div class="row">
			<div class="col-md-4" style="padding: 20px;">
				<div class="border-box">
					<div class="box">
						<div class="profile-details">
							<div  style="margin-top: -110px;padding: 20px;">
								<div class="avatar align-center"  style="height: 130px;width: 130px;">
									<img src="<?php echo BASE_URL; ?>/assets/img/avatar.png">
								</div>
							</div>
							<div style="text-align: center;">
								<h4>@<?php echo $user_login['username']; ?></h4>
								<!-- <h6>Processing..</h6> -->
							</div>
							<div class="profile-info">
								<div class="form-group">
									<label>Email:</label><b> <?php echo $user_login['email']; ?></b>
									<div style="font-size: 12px;">
										<a href="#">Change Email</a>
									</div>
								</div>
								<div>Firstname: <span id="profile-firstname"><?php echo $user_login['firstname']; ?></span></div>
								<div>Lastname: <span id="profile-lastname"><?php echo $user_login['lastname']; ?></span></div>
								<div>Birthday : <span id="profile-birthday"><?php echo $user_login['birthday']; ?></span></div>
								<div>Gender: <span id="profile-gender"><?php echo $user_login['gender']; ?></span></div>
							</div>
							<div><a href="#" id="edit-profile-info">Edit Profile</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8" style="padding: 20px;">
				<div class="theme-list">
					<h3>Background Setting</h3>
					<div class=" theme-thumnail">
						<div class="row">
							<?php 
								$backgound = array(
									'Default',
									'Smoke',
									'Nature',
									'City',
									'Sky'
								);
							 ?>
							<?php foreach( $backgound as $key => $value): ?>
							<div class="col-md-4">
								<div class="thumnail" data-index="<?php echo $key ?>" data-bg="bg<?php echo $key ?>.jpg" id="thumnail-<?php echo $key; ?>" style="background-image: url('<?php echo BASE_URL.'/assets/img/bg'.$key.'.jpg'; ?>');">
									<div class="bg-overlay text">
										<h5><?php echo $value; ?></h5>
									</div>
									<div class="tick" id="thumnail-tick-<?php echo $key ?>" style="<?php if('bg'.$key.'.jpg' == $user_login['setting']->background ) echo 'display: block;'?>">
										<span class="icon-tick"></span>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="edit-profile bg-overlay" id="edit-profile">
		<div class="col-sm-12 align-center" style="">
			<div class="align-center" style="max-width: 500px;">
				<div class="border-box">
					<div class="box">
						<div style="padding-bottom: 20px;position: relative;margin-bottom: 20px;border-bottom: 3px solid #c4620d;">
							<div class="avatar">
								<img src="<?php echo BASE_URL; ?>/assets/img/avatar.png">
							</div>
							<div style="position: absolute;top: 21px;left: 125px;">
								<h4>@<?php echo $user_login['username']; ?></h4>
								<h6>Editing...</h6>
							</div>
						</div>
						<div class="form-wrap">
							<form id="form-edit-profile" method="POST">
								<!-- <div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label>Quote</label>
											<span class="jojpi">:</span>
										</div>
										<div class="col-sm-8">
											<input type="text" name="quote" value="Processing..." placeholder="Quote" class="form-control input-radius float-right custom-control">
											<div class="error-message"></div>
										</div>
									</div>
								</div> -->
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label for="firstname">Firstname</label>
											<span class="jojpi">:</span>
										</div>
										<div class="col-sm-8">
											<input type="text" id="firstname" name="firstname" value="<?php echo $user_login['firstname']; ?>" class="form-control input-radius float-right custom-control" placeholder="Firstname">
											<div class="error-message"></div>
										</div>
									</div>
								</div>
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label for="lastname">Lastname</label>
											<span class="jojpi">:</span>
										</div>
										<div class="col-sm-8">
											<input type="text" id="lastname" name="lastname" value="<?php echo $user_login['lastname']; ?>" class="form-control input-radius  float-right custom-control" placeholder="Lastname">
											<div class="error-message"></div>
										</div>
									</div>
								</div>
								<div class="form-group custom-group">
									<div class="row">
										<div class="col-sm-4">
											<label for="birthday">Birthday</label>
											<span class="jojpi">:</span>
										</div>
										<div class="col-sm-8">
											<select class="form-control custom-control input-radius pointer float-left" name="birth-day">
												<?php for($i=1;$i<=31;$i++): ?>
													<option value="<?php echo $i; ?>" <?php if($i==intval(date('d', strtotime($user_login['birthday'])))) echo 'selected'; ?> >
														<?php echo $i; ?>
													</option>
												<?php endfor; ?>
											</select>
											<select class="form-control custom-control input-radius pointer float-left" style="margin: 0 5px;" name="birth-month">
												<?php for($i=1;$i<=12;$i++): ?>
													<option value="<?php echo $i; ?>" <?php if($i==intval(date('m', strtotime($user_login['birthday'])))) echo 'selected'; ?>>
														<?php echo format_month($i); ?>
													</option>
												<?php endfor; ?>
											</select>
											<input type="text" id="birth-year" name="birth-year" value="<?php echo date('Y', strtotime($user_login['birthday'])); ?>" class="form-control custom-control input-radius float-left" placeholder="-Year-" style="width: 75px;">
											<div class="error-message"></div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-4">
											<label for="gender">Gender</label>
											<span class="jojpi">:</span>
										</div>
										<div class="col-sm-8">
											<select id="gender" name="gender" class="form-control input-radius pointer custom-control">
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select>
											<div class="error-message"></div>
										</div>
									</div>
								</div>
								<div class="btn-submit custom-group">
									<input class="btn-radius float-right" type="submit" id="save" data-step="2" value="Save">
									<input class="btn-radius btn-back  float-right" type="button" id="edit-profile-cancel" data-step="2" value="Cancel" style="margin-right:15px;">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


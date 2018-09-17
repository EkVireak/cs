	
	<div class="container">
		<div class="row">
			<div class="col-sm-12 align-center" style="">
				<div class="register align-center">
					<div class="border-box">
						<div class="box">
							<div class="form-wrap">
								<form class="form-login" id="form-login" method="POST">
									<div class="form-inner">
										<div style="padding-bottom: 20px;">
											<div class="avatar align-center">
												<img src="<?php echo BASE_URL; ?>/assets/img/avatar.png">
											</div>
										</div>
										<div class="form-data">
											<div class="form-group">
												<div class="error-message" id="login-error"></div>
											</div>
											<div class="form-group">
												<input type="text" id="username" name="username" class="form-control input-radius" placeholder="Username / Email" autocomplete="off">
											</div>
											<div class="form-group">
												<input type="text" id="password" name="password" class="form-control input-radius" placeholder="Passowrd" autocomplete="off">
											</div>
											<div class="form-group">
												<input type="checkbox" name="remember">
												<label>Remember</label>
											</div>
											<div class="form-group">
												<span>No account?</span><a href="<?php echo BASE_URL.'/register/'; ?>"> Register </a><span>  now for free</span>
											</div>
										</div>
										 <!-- Button submit -->
										<div class="btn-submit custom-group">
											<a href="<?php echo BASE_URL; ?>/?anonymous">Skip</a>
											<input class="btn-radius float-right" type="submit" id="btn-login" data-step="1" value="Login">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
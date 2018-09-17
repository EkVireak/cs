	
	<div class="container">
		<div class="row">
			<div class="col-sm-12 align-center" style="">
				<div class="register align-center">
					<div class="border-box">
						<div class="box">
							<div class="form-wrap">
								<form class="form-register" id="form-register" method="POST">
									<div class="form-inner">
										<div class="step-head">
											<h4 class="float-left">Register</h4>
											<h4 class="float-right text-center step-number">
												1
											</h4>
										</div>
										<div style="padding-bottom: 20px;">
											<div class="avatar align-center">
												<img src="<?php echo BASE_URL; ?>/assets/img/avatar.png">
											</div>
										</div>
										<div class="form-group">
											<input type="hidden" id="step" name="step" value="1">
										</div>
										<div class="form-data">
											<div class="form-step step-active" id="form-step-1">
												<div class="form-group">
													<input type="text" id="firstname" name="firstname" class="form-control input-radius" placeholder="Firstname" autocomplete="off">
													<div class="error-message" id="firstname-error"></div>
												</div>
												<div class="form-group">
													<input type="text" id="lastname" name="lastname" class="form-control input-radius" placeholder="Lastname" autocomplete="off">
													<div class="error-message" id="lastname-error"></div>
												</div>
												<div class="form-group custom-group" style="margin-bottom: 1rem;">
													<input type="text" id="birthday" name="birthday" class="form-control input-radius" disabled style="width: 85px; display: inline-block;" value="Birthday">
													<select id="birth-day" name="birth-day" class="form-control input-radius pointer" style="width: auto; display: inline-block;">
														<option value="">-Day-</option>
														<?php for($i=1;$i<=31;$i++): ?>
															<option value="<?php echo $i; ?>">
																<?php echo $i; ?>
															</option>
														<?php endfor; ?>
													</select>
													<select id="birth-month" name="birth-month" class="form-control input-radius pointer" style="width: auto; display: inline-block;">
														<option value="">-Month-</option>
														<option value="1">January</option>
														<option value="2">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">Mayl</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
													<input type="text" id="birth-year" name="birth-year" class="form-control input-radius" placeholder="-Year-" autocomplete="off" style="width: 75px; display: inline-block;">
												</div>
												<div class="form-group">
													<select id="gender" name="gender" class="form-control input-radius pointer">
														<option value="">Gender</option>
														<option value="male">Male</option>
														<option value="female">Female</option>
													</select>
												</div>
												<div class="form-group">
													<span>Already have account?</span><a href="<?php echo BASE_URL.'/login/'; ?>"> Login </a><span>  now</span>
												</div>
											</div><!-- #form-step-1 -->
											<div class="form-step " id="form-step-2">
												<div class="form-group">
													<input type="text" id="username" name="username" class="form-control input-radius" placeholder="Username" autocomplete="off">
													<div class="error-message" id="username-error"></div>
												</div>
												<div class="form-group">
													<input type="text" id="email" name="email" class="form-control input-radius" placeholder="Email" autocomplete="off">
													<div class="error-message" id="email-error"></div>
												</div>
												<div class="form-group">
													<input type="text" id="password" name="password" class="form-control input-radius" placeholder="Passowrd" autocomplete="off">
													<div class="error-message" id="password-error"></div>
												</div>
												<div class="form-group">
													<input type="text" id="cpassword" name="cpassword" class="form-control input-radius" placeholder="Confirm Password" autocomplete="off">
													<div class="error-message" id="cpassword-error"></div>
												</div>
												<div class="form-group">
													<input type="checkbox" name="accept-term"><span>Accept to ourt <a href="#">Terms & Condition</a></span>
													<div class="error-message" id="accept-term-error"></div>
												</div>
											</div><!-- #form-step-2 -->
										</div>
										 <!-- Button submit -->
										 <input type="hidden" name="step" value="1">
										<div class="btn-submit custom-group">
											<input class="btn-radius btn-back" type="button" id="btn-back" data-step="1" value="Back">
											<input class="btn-radius float-right" type="submit" id="btn-register" data-step="1" value="Next">
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

	<div class="nav">
		<!-- <div class="profile-picture">
			<?php if( isset($_SESSION['userlogin']) && is_array($_SESSION['userlogin']) ): ?>
			<a href="<?php echo BASE_URL.'/profile/?user='.$_SESSION['userlogin']['username']; ?>">
			<?php else: ?>
			<a href="#">
			<?php endif; ?>
				<div class="profile-picture-inner pointer">
					<div class="avatar">
						<?php echo get_avatar(); ?>
					</div>
					<div class="text">
						<div class="username">
							<span>@<?php
									if( isset($_SESSION['userlogin']['username']) ) echo $_SESSION['userlogin']['username']; 
									else echo 'anonymous'; ?>
							</span>
						</div>
						<div class="quote">
							CS System
						</div>
					</div>
				</div>
			</a>
		</div> -->
		<!-- <div class="logout">
			<?php if( isset($_SESSION['userlogin']) && is_array($_SESSION['userlogin']) ): ?>
				<button class="btn-radius" id="btn-logout">Logout</button>
			<?php else: ?>
				<a href="<?php echo BASE_URL;?>/login"><button class="btn-radius" id="btn-login">Login</button></a>
			<?php endif; ?>
		</div> -->
		<div class="logo">
			<div class="logo-inner">
				<a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>/assets/img/logo.png" alt="LOGO"></a>
			</div>
		</div>
		<?php if( isset($_SESSION['userlogin']) && is_array($_SESSION['userlogin']) ): ?>
		<div class="button-list">
			<div class="button-list-inner">
				<div class="avatar">
					<?php echo get_avatar(); ?>
				</div>
				<button class="btn-radius" id="btn-drop-list">@<?php echo $_SESSION['userlogin']['username']; ?></button>
				<div class="list-drop" id="list-drop">
					<ul>
						<li><a href="<?php echo BASE_URL.'/profile/?user='.$_SESSION['userlogin']['username']; ?>">View Profile</a></li>
						<li><a href="#"  id="btn-logout">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
		<?php else: ?>
			<div class="login-top">
				<a href="<?php echo BASE_URL;?>/login"><button class="btn-radius">Login</button></a>
			</div>
		<?php endif; ?>
		<!-- <div class="user-nav">
			<div class="user-nav-inner">
				<ul>
					<li><a href="#">View Profile</a></li>
					<li><a href="#">Logout</a></li>
				</ul>
			</div>
		</div> -->
	</div>
	<!-- Loading -->
	<div class="loading text-center" id="loading">
		<div class="loading-ring"><div></div></div>
	</div>
	<!-- <div class="editing"><div></div><div></div><div></div><div></div></div> -->
	
	<!-- Script -->
	<script type="text/javascript">
		var BASE_URL = '<?php echo BASE_URL; ?>';
		var CS_AJAX = '<?php echo AJAX_URL; ?>/cs-ajax.php';
		var PROCESS_AJAX = '<?php echo AJAX_URL; ?>/process.php';
		var SERVICES_AJAX = '<?php echo AJAX_URL; ?>/services.php';
		<?php if( isset($_SESSION['userlogin']) && is_array($_SESSION['userlogin']) ): ?>
		var USERNAME = "<?php echo $_SESSION['userlogin']['username']; ?>";
		var USER_ID = "<?php echo $_SESSION['userlogin']['id']; ?>";
		var AVATAR = "<?php echo $_SESSION['userlogin']['avatar']; ?>";
		<?php endif; ?>
	</script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/cs.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/register.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/login.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/profile.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/edit-profile.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/process.js"></script>
</body>
</html>
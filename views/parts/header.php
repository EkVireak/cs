<!DOCTYPE html>
<html>
<head>
	<title>CS System</title>
	<!-- CSS -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bootstrap-4.0.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/cs.css">
</head>
<?php if( isset($_POST['userlogin']) ): ?>
<body data-bg="<?php echo $user_login['setting']->background; ?>" style="background-image: url('<?php echo BASE_URL.'/assets/img/'.$user_login['setting']->background; ?>');">
<?php else: ?>
<body style="background-image: url('<?php echo BASE_URL.'/assets/img/bg0.jpg'; ?>');">
<?php endif; ?>
	<div class="bg-overlay" style="position: fixed;"></div>
	
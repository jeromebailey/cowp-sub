<!DOCTYPE html>
<html lang="en">
<head>
	<title>SIR Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=base_url('assets/images/favicon.png');?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css');?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/font-awesome.min.css');?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/icon-font.min.css');?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/animate.css');?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/hamburgers.min.css');?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/animsition.min.css');?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/select2.min.css');?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/daterangepicker.css');?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/util.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/main.css');?>">
<!--===============================================================================================-->
</head>
<body style="background-color: #ffffff;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<form class="login100-form validate-form" method="post" action="<?=base_url('Users/do_login');?>">

					<h3 class="text-center">Inventory & Requisition System (SIR), Grand Cayman</h3>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<img src="<?=base_url('assets/images/GCG-Intro.gif');?>">
						</div>
					</div>

					<span class="login100-form-title p-b-43">
						Login to continue
					</span>

					<?include_once 'includes/status_message.inc';?>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" required="required" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" required="required" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>		

					<div class="container-login100-form-btn">
						<input type="submit" name="" class="login100-form-btn" value="Login">
					</div>
					
				</form>

				<div class="login100-more" style="background-image: url(<?=base_url('assets/images/inventory-01.jpg');?>">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="<?=base_url('assets/js/jquery-3.2.1.min.js');?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('assets/js/animsition.min.js');?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('assets/js/popper.js');?>"></script>
	<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('assets/js/select2.min.js');?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('assets/js/moment.min.js');?>"></script>
	<script src="<?=base_url('assets/js/daterangepicker.js');?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('assets/js/countdowntime.js');?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('assets/js/main.js');?>"></script>

</body>
</html>
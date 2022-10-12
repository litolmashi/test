<?php 
   session_start();
   error_reporting();
   if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
   	<meta name="author" content="AdminKit">
   	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

   	<link rel="preconnect" href="https://fonts.gstatic.com">
   	<link rel="shortcut icon" href="/blockchainsys/kit/static/blockchain/buyer/C - OFFICIAL.png" />

   	<title>Sign In | youCraft</title>

   	<link href="../kit/dist/css/app.css" rel="stylesheet">
   	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
   	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   </head>

   <body>
   	<div class="text-center mt-4"><br><br><br><br>
      	<center>
          <div class="eltd-logo-wrapper">
									<a href="index.php" style="text-decoration:none;color:black;">
									<img src="/blockchainsys/kit/static/blockchain/buyer/youCraft-logo3- cream.png" alt="Logo" width="210" height="80"/><br>
                                      	<small>Tatak Lokal. Gawang Lokal. Hindi Lang Para sa Lokal.</small>
									</a>
								</div>
      </center>
		<br>
   		<h1 class="h2">Welcome back!</h1>
   		<p class="lead">Sign in to your account to continue</p>
   	</div>
   	<div class="container d-flex justify-content-center align-items-center">

      	<form class="boxinput border shadow p-3 rounded" action="php/check-login.php" method="post" style="width: 50%;">
		  <!-- ALERT MESSAGES -->
			<?php
				if ( isset($_GET['result']) && $_GET['result'] == 1 )
					{
						echo '
						<div class="alert alert-success alert-dismissible mb-2" role="alert">
							
							<div class="alert-message">
							<strong>Success!</strong> You can now login!
							</div>
						</div>';}
				if ( isset($_GET['result']) && $_GET['result'] == 2 )
						{
							echo '
							<div class="alert alert-danger alert-dismissible mb-2" role="alert">
								<div class="alert-message">
								<strong>Failed. </strong> Your account was not created!
								</div>
							</div>';}
				if ( isset($_GET['result']) && $_GET['result'] == 3 )
						{
							echo '
							<div class="alert alert-danger alert-dismissible mb-2" role="alert">
								<div class="alert-message">
								<strong>Failed. </strong> Your account was not created! Email already exist.
								</div>
							</div>';}
			?>
			<!--  -->
      		<h1 class="text-center p-3">LOGIN</h1>
      		<?php if (isset($_GET['error'])) { ?>
      			<div class="alert alert-danger" role="alert">
      				<?=$_GET['error']?>
      			</div>
			
			
      		<?php } ?>
      		<div class="mb-2">
      			<label for="email" 
		           class="form-label mb-0">Email</label>
		         <input type="text" 
		           class="form-control" 
		           name="email" 
		           id="email">
		      </div>

		      <div class="mb-2">
		      	<label for="password" 
		           class="form-label mb-0">Password</label>
		         <input type="password" 
		           name="password" 
		           class="form-control" 
		           id="password">
		      </div>

		      <div class="link forget-pass text-left mb-4">
		      	<a href="php/forgot-password.php">
		      		<small>Forgot password?</small>
		      	</a>
		      </div>

		      <div class="text-center mt-3 mb-4">
		      	<center>
		      		<button type="submit" class="btn btn-primary">Sign In</button>
		      	</center>
		      </div>
			  <div class="link forget-pass text-left mb-4">
		      	<a href="php/create-new-account.php">
		      		<center><small>Or create a new account</small></center>
		      	</a>
		      </div>
		   </form>
		</div>

		<div class="text-center mt-0">
			<!-- <img src="./kit/dist/img/avatars/logo.png" alt="USeP Logo" class="img-fluid rounded-circle" width="100" height="100"> -->
			<div>
				<small>All Rights Reserved. &copy 2022</small>
			</div>
		</div>
	</body>
</html>

<script src="../kit/dist/js/app.js"></script>


<style type="text/css">
	body {
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    background-color: #f5f7fb;
    color: #495057;
    font-family: var(--bs-font-sans-serif);
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    margin: 0;
    -webkit-text-size-adjust: 100%;
	}

	.boxinput{
		background-color: white;
	}
</style>

<?php }else{
	header("Location: login.php");
} ?>



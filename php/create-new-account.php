<?php 
   session_start();
   error_reporting();
   ini_set('display_errors', 1);
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

   		<title>Sign Up | youCraft</title>

   		<link href="../kit/dist/css/app.css" rel="stylesheet">
   		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
   		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   </head>

   <body>
   		<div class="text-center mt-4">
          <center>
          <div class="eltd-logo-wrapper">
									<a href="../index.php" style="text-decoration:none;color:black;">
									<img src="/blockchainsys/kit/static/blockchain/buyer/youCraft-logo3- cream.png" alt="Logo" width="210" height="80"/><br>
                                      	<small>Tatak Lokal. Gawang Lokal. Hindi Lang Para sa Lokal.</small>
									</a>
								</div>
      </center>
			<br>
   			<h1 class="h2">Hello! We're glad seeing you here!</h1>
   			<p class="lead">Sign up and create an account to use the service.</p>
   		</div>
		
   		<div class="container d-flex justify-content-center align-items-center col-md-12">
      		<form class="boxinput border shadow p-4 rounded" action="/blockchainsys/kit/static/includes/createAccount.php" method="post" style="width: 50%;">
      		<h1 class="text-center">SIGN UP</h1>
      		<?php if (isset($_GET['error'])) { ?>
      			<div class="alert alert-danger" role="alert">
      				<?=$_GET['error']?>
      			</div>
      		<?php } ?>
			
			<div class="mb-2">
		      	<label for="email" class="form-label mb-0">Email</label>
		        <input type="email" name="email" class="form-control" id="email" required="">
		    </div>

      		<div class="mb-2">
      			<label for="username" class="form-label mb-0">Username</label>
		        <input type="text" class="form-control" name="username" id="username" required="">
		    </div>

		    <div class="mb-2">
		      	<label for="password" class="form-label mb-0">Password</label>
				<input type="password" name="password" class="form-control" id="password" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and lowercase letter, one special character, and at least 8 or more characters.">
				<div id="message">
					<em>
						<small class="form-text text-muted mb-0 mt-0"><strong>Password must contain the following:</strong></small><br>
						<small id="letter" class="invalid form-text text-muted">A <strong>lowercase</strong> letter, </small>
						<small id="capital" class="invalid form-text text-muted">A <strong>capital (uppercase)</strong> letter, </small>
						<small id="number" class="invalid form-text text-muted">A <strong>number, </strong></small>
						<small id="length" class="invalid form-text text-muted">Minimum <strong>8 characters, and </strong></small>
						<small id="special" class="invalid form-text text-muted">A <strong>special character. </strong></small>
			  		</em>
				</div>
		    </div>

			<div class="mb-2">
		      	<label for="firstname" class="form-label mb-0">First Name</label>
		         <input type="text" name="firstname" class="form-control" id="firstname" required="">
		    </div>

			<div class="mb-2">
		      	<label for="middlename" class="form-label mb-0">Middle Name</label>
		         <input type="text" name="middlename" class="form-control" id="middlename" required="">
		    </div>

			<div class="mb-2">
		      	<label for="lastname" class="form-label mb-0">Last Name</label>
		         <input type="text" name="lastname" class="form-control" id="lastname" required="">
		    </div>

			<div class="mb-2 col-md-12">
			<label for="gender" class="form-label mb-0 col-md-12">Gender</label>
				<center>
				<label class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="gender" value="Female" required="">
					<span class="form-check-label">Female</span>
				</label>

				<label class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="gender" value="Male" required="">
					<span class="form-check-label">Male</span>
				</label>

				<label class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="gender" value="Prefer not to say" required="">
					<span class="form-check-label">Prefer not to say</span>
				</label>
			  	</center>
		    </div>

			<div class="mb-2">
		      	<label for="birthday" class="form-label mb-0">Date of Birth</label>
		         <input type="date" name="birthday" class="form-control" id="birthday" required="">
		    </div>

			<div class="mb-2">
		      	<label for="address" class="form-label mb-0">Address</label>
		         <input type="address" name="address" class="form-control" id="address" required="">
		    </div>

			<div class="mb-2">
		      	<label for="role" class="form-label mb-0">What Are You?</label>
				  <center>
				<label class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="role" value="1" required="">
					<span class="form-check-label">a Buyer</span>
				</label>

				<label class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="role" value="2" required="">
					<span class="form-check-label">a Seller</span>
				</label>
			  	</center>
		    </div>
			<hr class="mt-0">
		    <div class="text-center mb-2">
		      	<center>
		      		<button name="submit" type="submit" class="btn btn-primary">Create Account</button>
		      	</center>
		    </div>

			<div class="link forget-pass text-left mb-1">
		      	<a href="forgot-password.php">
		      		<center><small>Forgot password instead?</small></center>
		      	</a>
		    </div>
		   	</form>
		</div>

		<div class="text-center">
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
	header("Location: error.php");
} ?>

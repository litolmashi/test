<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link rel="preconnect" href="https://fonts.gstatic.com">
  	<link rel="shortcut icon" href="/blockchainsys/kit/static/blockchain/buyer/C - OFFICIAL.png" />

   	<title>Forgot Password | youCraft</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="../kit/dist/css/app.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center col-md-12" style="padding: 250px;">
        <div class="row">
            <div class="col-md-12 offset-md-0 form">
              <center>
          <div class="eltd-logo-wrapper">
									<a href="../index.php" style="text-decoration:none;color:black;">
									<img src="/blockchainsys/kit/static/blockchain/buyer/youCraft-logo3- cream.png" alt="Logo" width="260" height="100"/><br>
                                      	<small>Tatak Lokal. Gawang Lokal. Hindi Lang Para sa Lokal.</small>
									</a>
								</div>
      </center>
			<br>
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <h2 class="text-center mb-0">Forgot Password</h2>
                    <p class="text-center mb-1 mt-1">Enter your email address</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group mb-1">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button btn btn-primary" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="text-center">
			<!-- <img src="./kit/dist/img/avatars/logo.png" alt="USeP Logo" class="img-fluid rounded-circle" width="100" height="100"> -->
			<div>
				<small>All Rights Reserved. &copy 2022</small>
			</div>
		</div>
</body>
</html>


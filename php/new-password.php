<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: ../index.php');
}
?>
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
    <title>Create a New Password | youCraft</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="../kit/dist/css/app.css" rel="stylesheet">
    <link rel="shortcut icon" href="/blockchainsys/kit/static/blockchain/buyer/C - OFFICIAL.png" />
    <link rel="stylesheet" href="kstyles2.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center col-md-12" style="padding: 110px;">
        <div class="row">
            <div class="col-md-8 offset-md-2 form">
              <br><br>
              <center>
          <div class="eltd-logo-wrapper">
									<a href="../index.php" style="text-decoration:none;color:black;">
									<img src="/blockchainsys/kit/static/blockchain/buyer/youCraft-logo3- cream.png" alt="Logo" width="260" height="100"/><br>
                                      	<small>Tatak Lokal. Gawang Lokal. Hindi Lang Para sa Lokal.</small>
									</a>
								</div>
      </center>
                <form action="new-password.php" method="POST" autocomplete="off">
                    <h2 class="text-center mb-1 mt-1">New Password</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center mb-1">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center mb-1">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>   -->
                    <div id="message">
                        <b class="mb-1">Password must contain the following:</b>
                        <p id="letter" class="invalid mb-1">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid mb-1">A <b>capital (uppercase)</b> letter</p>
                        <p id="number" class="invalid mb-1">A <b>number</b></p>
                        <p id="length" class="invalid mb-1">Minimum <b>8 characters</b></p>
                        <p id="special" class="invalid mb-1">A <b>special character</b></p>
                        </div>
                        <div class="form-group mb-1">
                        <input type="password" id="pass" name="password" class="form-control" placeholder="Create new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        </div>
                    <div class="form-group mb-1">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button btn btn-primary" type="submit" name="change-password" value="Change">
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
    <script src="kscript2.js"></script>
</body>
</html>

<?php require_once "controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
if($email == false){
  header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification | youCraft</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="../kit/dist/css/app.css" rel="stylesheet">
    <link rel="shortcut icon" href="/blockchainsys/kit/static/blockchain/buyer/C - OFFICIAL.png" />
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center col-md-12" style="padding: 210px;">
        <div class="row">
            <div class="col-md-8 offset-md-2 form">
              <center>
          <div class="eltd-logo-wrapper">
									<a href="../index.php" style="text-decoration:none;color:black;">
									<img src="/blockchainsys/kit/static/blockchain/buyer/youCraft-logo3- cream.png" alt="Logo" width="210" height="80"/><br>
                                      	<small>Tatak Lokal. Gawang Lokal. Hindi Lang Para sa Lokal.</small>
									</a>
								</div>
      </center>
                <form action="reset-code.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center mb-1" style="padding: 0.4rem 0.4rem">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group mb-1">
                        <input class="form-control" type="text" name="otp" placeholder="Enter code" required>
                    </div>
                    <div class="form-group mb-1">
                        <input class="form-control button btn btn-primary" type="submit" name="check-reset-otp" value="Submit">
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

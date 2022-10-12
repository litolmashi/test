<?php require_once "controllerUserData.php"; ?>
<?php
if($_SESSION['info'] == false){
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Changed | youCraft</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="../kit/dist/css/app.css" rel="stylesheet">
    <link rel="shortcut icon" href="/blockchainsys/kit/static/blockchain/buyer/C - OFFICIAL.png" />
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center col-md-12" style="padding-top: 250px;">
        <div class="row">
            <div class="col-md-12 offset-md-0 form login-form">
              <center>
          <div class="eltd-logo-wrapper">
									<a href="../index.php" style="text-decoration:none;color:black;">
									<img src="/blockchainsys/kit/static/blockchain/buyer/youCraft-logo3- cream.png" alt="Logo" width="260" height="100"/><br>
                                      	<small>Tatak Lokal. Gawang Lokal. Hindi Lang Para sa Lokal.</small>
									</a>
								</div>
      </center>
            <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center mb-1">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
                <form action="../login.php" method="POST">
                    <div class="form-group">
                        <input class="form-control button btn btn-primary" type="submit" name="login-now" value="Login Now">
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

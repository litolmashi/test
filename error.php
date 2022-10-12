<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location: ../blockchainsys/login.php");
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
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Blockchain Electronic Commerce</title>

	<link href="/blockchainsys/kit/dist/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body>
	<main class="d-flex w-100 h-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center">
							<h1 class="display-1 font-weight-bold">404</h1>
							<p class="h1">Page not found.</p>
							<p class="h2 font-weight-normal mt-3 mb-4">The page you are trying to access is not allowed for your current user level. Please contact your administrator or try logging in again with proper user level account.</p>
							<a href="/blockchainsys/dismiss/logout.php" class="btn btn-primary btn-lg">Return to website</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
</body>

</html>
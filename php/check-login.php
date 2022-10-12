<?php  
ini_set('display_errors', 1);
session_start();
//include "../config/db_config.php";
//$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if (isset($_POST['email']) && isset($_POST['password'])) {

	$Getemail = $_POST['email'];
	$password = $_POST['password'];

	if (empty($Getemail)) {
		header("Location: ../login.php?error=Username is Required");
	}else if (empty($password)) {
		header("Location: ../login.php?error=Password is Required");
	}else {
		$password = sha1($password);

		//FROM BLOCKCHAIN LOGIN
		$path = $_SERVER['DOCUMENT_ROOT'];
   		$path .= "/blockchainsys/config/";

   		//require_once($path.'vendor/autoload.php');

   		//$dotenv = Dotenv\Dotenv::createImmutable($path);
   		//$dotenv->load();
      
      	require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");

        //$dotenv = Dotenv\Dotenv::createImmutable($path);
        //$dotenv->load();
        

        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');

   		//$client = new MongoDB\Client('mongodb+srv://'.$_ENV['MDB_USER'].':'.$_ENV['MDB_PASS'].'@'.$_ENV['ATLAS_CLUSTER_SRV'].'/?retryWrites=true&w=majority&tls=true');
   		$collection = $client->adminDB->userCredentials;
		$query=array();
   		$cursor2=$collection->find(['user_email' => $Getemail],$query);

   		//$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

   		foreach ($cursor2 as $doc) {
			$getBlockEmail = $doc['user_email'];
			$getBlockPassword = $doc['user_password'];
   		}
		if($getBlockEmail === $Getemail && $getBlockPassword === $password){
			// echo "I AM TRUE";
			$getRole = $doc['user_role'];
			$_SESSION['name'] = $doc['user_firstname']." ".$doc['user_middlename']." ".$doc['user_lastname'];
			$_SESSION['username'] = $doc['user_name'];
			$_SESSION['userID'] = $doc['user_ID'];
			$_SESSION['role'] = $doc['user_role'];
			$_SESSION['logged'] = 'LOGGED';
          	$_SESSION['email'] = $doc['user_email'];

			if($getRole == '2'){?>
				<script>
					sessionStorage.setItem('userlogged', true);
				</script><?php
              	//sessionStorage.setItem('userlogged', true);
				$_SESSION['nameType'] = "Seller";
				$_SESSION['logged'] = 'LOGGED';
				include_once "/var/www/webroot/blockchainsys/kit/static/includes/createDB.php";
			}else if($getRole == '1'){?>
              	<script>
					sessionStorage.setItem('userlogged', true);
				</script><?php
              	//sessionStorage.setItem('logged', true)
				$_SESSION['nameType'] = "Buyer";
				$_SESSION['logged'] = 'LOGGED';
				include_once "/var/www/webroot/blockchainsys/kit/static/includes/createDB.php";
			}else{
				header("Location: ../login.php?error=Account disabled, contact your administrator");
			}
		}else if($getBlockEmail === $Getemail && $getBlockPassword <> $password){
			header("Location: ../login.php?error=Your password is incorrect, try again!");
		}else{
			header("Location: ../login.php?error=No account found. Sign up now to enjoy our service!");
		}
		
		//END OF BLOCKCHAIN

		//LOGIN THROUGH LOCAL DATABASE
		// $getCreds = "SELECT * FROM users WHERE email='$Getemail' AND upassword='$password'";
		// $result = $conn->query($getCreds);

		// if ($result->num_rows > 0) {
		// 	while($row = $result->fetch_assoc()) {
		// 		$getRole = $row['role'];
		// 	  	$_SESSION['name'] = $row['firstname']." ".$row['middlename']." ".$row['lastname'];
		// 	  	$_SESSION['username'] = $row['username'];
        // 		$_SESSION['userID'] = $row['user_ID'];
		// 		$_SESSION['role'] = $row['role'];

		// 		//LOGGING IN
		// 		if($getRole == '2'){
		// 			$_SESSION['nameType'] = "Seller";                 
		// 			// header("Location: ../kit/static/blockchain/seller/dashboard.php");
		// 			include_once "../kit/static/includes/createDB.php";
		// 		}else if($getRole == '1'){
		// 			$_SESSION['nameType'] = "Buyer";
		// 			// header("Location: ../kit/static/blockchain/buyer/");
		// 			include_once "../kit/static/includes/createDB.php";
		// 		}else{
		// 			header("Location: ../login.php?error=No account found.");
		// 		}
		// 	}
		//   } else {
		// 		header("Location: ../login.php?error=Email or password is incorrect or no account found!");
		//   }
		//END OF LOGIN THROUGH LOCAL DATABASE
	}
}else {
	header("Location: ../login.php?error=No account found.");
}
?>




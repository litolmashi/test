
<?php
    session_start();
    ini_set('display_errors', 1);

    //CONNECTING TO THE LOCAL DATABASE
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    //CONNECTING TO THE BLOCKCHAIN
   	$Mongopath = "/var/www/webroot/blockchainsys/config/";
    require_once($Mongopath.'vendor/autoload.php');
    //ESTABLISHING CONNECTIONS TO LOCAL DATABASE
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $userConn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    // $Enconn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    // $authConn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    //ESTABLISHING CONNECTION TO BLOCKCHAIN DB
    $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
    $collection = $client->adminDB->userCredentials;

    //SETTING DATE AND TIME OF CREATION
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('m-d-Y h:i:s a');

    //GENERATE A RANDOM USER ID FOR EACH USER
    $userID = uniqid();

    //FETCHING THE INFORMATION FROM THE FORM
    $getEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $getUsername = mysqli_real_escape_string($conn, $_POST['username']);
    $getPassword = sha1(mysqli_real_escape_string($conn, $_POST['password']));
    $getFirstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $getMiddlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $getLastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $getGender = mysqli_real_escape_string($conn, $_POST['gender']);
    $getBirthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $getAddress = mysqli_real_escape_string($conn, $_POST['address']);
    $getRole = mysqli_real_escape_string($conn, $_POST['role']);
    $result = array();

    if(isset($_POST["submit"])){
        //CHECK FOR REDUNDANCY BLOCK
        $query=array();
        $cursor2=$collection->find(['user_email' => $getEmail]);
        foreach ($cursor2 as $doc) {
			$getBlockEmail = $doc['user_email'];
   		}
		if($getBlockEmail === $getEmail){
            header('Location: /blockchainsys/login.php?result=3');
        }else{
            //ADDING TO BLOCKCHAIN
            $insertOneResult = $collection->insertOne([
                'user_ID' => $userID,
                'user_PrivateKey' => '',
                'user_PublicKey' => 'null',
                'user_firstname' => $getFirstname,
                'user_middlename' => $getMiddlename,
                'user_lastname' => $getLastname,
                'user_gender' => $getGender,
                'user_name' => $getUsername,
                'user_password' => $getPassword,
                'user_role' => $getRole,
                'user_email' => $getEmail,
                'user_resetCode' => '',
                'user_dateCreation' => $currentDate
            ]);
            header('Location: /blockchainsys/login.php?result=1');
            //ADDING TO LOCAL DATABASE (OPTIONAL)
            
            //CHECK FOR REDUNDANCY
            // $checkUserExist = "SELECT * FROM users WHERE email='$getEmail'";
            // $resultUser = mysqli_query($userConn, $checkUserExist);
            // $userRow = mysqli_fetch_assoc($resultUser);
            // $userCred = $userRow['email'];

            // if($userCred == $getEmail){
            //     header('Location: /blockchainsys/login.php?result=3');
            // }else{
            //     $query = "INSERT into users (user_ID, firstname, middlename, lastname, gender, birthdate, username, upassword, role, email, address) VALUES ('$userID','$getFirstname','$getMiddlename','$getLastname','$getGender','$getBirthday','$getUsername','$getPassword','$getRole','$getEmail','$getAddress')";
            //     if(mysqli_query($conn, $query) == TRUE){
            //     header('Location: /blockchainsys/login.php?result=1');
            //     }else{
            //         header('Location: /blockchainsys/login.php?result=2');
            //     }
            // }
        }
    }
    // $conn -> close();
?>

<?php
   //BLOCKCHAIN SETTINGS
   //$path = $_SERVER['DOCUMENT_ROOT'];
   //$path .= "/blockchainsys/config/";
   //$newpath = $_SERVER['DOCUMENT_ROOT'];
   $newpath = "/var/www/webroot/blockchainsys/config/db_config.php";

   //require_once($path.'vendor/autoload.php');
   include_once($newpath);

   //$dotenv = Dotenv\Dotenv::createImmutable($path);
   //$dotenv->load();

   require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");
	$client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
   $collection = $client->sellerDB->productInformation;
   $brandsCollection = $client->adminDB->brandInformation;
	$usersCollection = $client->adminDB->userCredentials;

   $query=array();
   $cursor2=$collection->find(['previousOwner' => $_SESSION['userID'], 'status' => 'ACTIVE'],$query);

   $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
   $newConn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
   $brandConn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$UsersConn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

   date_default_timezone_set('Asia/Manila');

   $create = "CREATE TABLE IF NOT EXISTS `productsbc` (
      `id` int(255) NOT NULL AUTO_INCREMENT UNIQUE KEY,
      `productid` varchar(255) NOT NULL PRIMARY KEY,
      `userid` varchar(255) DEFAULT NULL,
      `brand` varchar(255) DEFAULT NULL,
      `name` varchar(255) DEFAULT NULL,
      `price` int(255) DEFAULT NULL,
      `quantity` int(255) DEFAULT NULL,
      `description` varchar(255) DEFAULT NULL,
      `dateadded` varchar(255) DEFAULT NULL,
      `status` varchar(255) DEFAULT NULL
   )";
   $res = $newConn->query($create);

   foreach ($cursor2 as $doc) {
      $query = "INSERT IGNORE into productsbc (name, brand, userid, productid, quantity, price, description, dateadded, status) VALUES ('$doc[productName]', '$doc[brandName]', '$doc[previousOwner]', '$doc[productID]','$doc[productQuantity]', '$doc[productPrice]', '$doc[productDescription]','$doc[dateAdded]','active')";
          if(mysqli_query($conn, $query) == TRUE){
          }
          else{
          }
   }
   
   $createBrands = "CREATE TABLE IF NOT EXISTS `brandsbc` (
      `id` int(255) NOT NULL AUTO_INCREMENT UNIQUE KEY,
      `brandid` varchar(255) NOT NULL PRIMARY KEY,
      `brand` varchar(255) DEFAULT NULL,
      `description` varchar(500) DEFAULT NULL,
      `datecreated` varchar(500) DEFAULT NULL,
      `previousowner` varchar(500) DEFAULT NULL,
      `currentowner` varchar(500) DEFAULT NULL,
      `datetransferred` varchar(500) DEFAULT NULL
      
   )";
   $resBrands = $brandConn->query($createBrands);

   $queryBrands=array();
   $cursorBrands=$brandsCollection->find(['previousOwnerID' => $_SESSION['userID']],$queryBrands);

   $queryBrandsSeller=array();
   $cursorBrandsSeller=$brandsCollection->find(['brandOwner' => $_SESSION['name']], $queryBrandsSeller);

   foreach ($cursorBrands as $docBrands) {
      $queryAdd = "INSERT IGNORE into brandsbc (brand, brandid, description, datecreated, previousowner, currentowner, datetransferred) VALUES ('$docBrands[brandName]', '$docBrands[brandID]', '$docBrands[brandDescription]','$docBrands[dateCreated]', '$docBrands[previousOwner]', '$docBrands[currentOwner]', '$docBrands[dateTransferred]')";
          if(mysqli_query($conn, $queryAdd) == TRUE){
          }
          else{
          }
   }
   foreach ($cursorBrandsSeller as $docBrandsSeller) {
      $queryUpdate = "UPDATE
                    brandsbc
                    SET
                    previousowner = '$docBrandsSeller[previousOwner]', 
                    currentowner = '$docBrandsSeller[currentOwner]', 
                    datetransferred = '$docBrandsSeller[dateTransferred]'
                    WHERE
                    brandid = '$docBrandsSeller[brandID]'";
          if(mysqli_query($conn, $queryUpdate) == TRUE){
          }
          else{
          }
   }
	$createUsers = "CREATE TABLE IF NOT EXISTS `users` (
      `id` int(255) NOT NULL AUTO_INCREMENT UNIQUE KEY,
      `email` varchar(255) NOT NULL PRIMARY KEY,
      `code` varchar(255) DEFAULT NULL
   )";
   $resUsers = $UsersConn->query($createUsers);
	
	$queryUsers=array();
   $cursorUsers=$usersCollection->find(['user_email' => $_SESSION['email']], $queryUsers);

   foreach ($cursorUsers as $docUsers) {
      $queryAddUsers = "INSERT IGNORE into users (email, code) VALUES ('$docUsers[user_email]', '$docUsers[user_resetCode]')";
          if(mysqli_query($conn, $queryAddUsers) == TRUE){
          }
          else{
          }
   }
   //END OF BLOCKCHAIN SETTINGS
?>


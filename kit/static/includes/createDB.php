<?php
    // session_start();
    //$newpath = $_SERVER['DOCUMENT_ROOT'];
    $newpath = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($newpath);
    $newConn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $brandConn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$UsersConn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);


    $orderTable ="CREATE TABLE IF NOT EXISTS `orders` (
        `id` int(200) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `sellerid` varchar(255) DEFAULT NULL,
        `userid` varchar(255) DEFAULT NULL,
        `productid` varchar(200) DEFAULT NULL,
        `brand` text DEFAULT NULL,
        `name` text DEFAULT NULL,
        `subquantity` int(255) DEFAULT NULL,
        `quantity` int(200) DEFAULT NULL,
        `subprice` int(255) DEFAULT NULL,
        `price` int(200) DEFAULT NULL,
        `orderdate` varchar(255) DEFAULT NULL,
        `address` varchar(500) DEFAULT NULL,
        `status` varchar(200) DEFAULT NULL,
        `fullname` text DEFAULT NULL,
        `delivery` varchar(255) DEFAULT NULL,
        `payment` varchar(255) DEFAULT NULL,
        `cancelDate` varchar(255) DEFAULT NULL,
        `receivedDate` varchar(255) DEFAULT NULL,
        `shippedDate` varchar(255) DEFAULT NULL,
        `email` varchar(255) DEFAULT NULL,
        `phone` varchar(255) DEFAULT NULL,
        `notes` varchar(255) DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    $resOrder = $newConn->query($orderTable);
    
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
    if($res === TRUE){
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/blockchainsys/config/";

        require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");

        //$dotenv = Dotenv\Dotenv::createImmutable($path);
        //$dotenv->load();
        

        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');

        $collection = $client->sellerDB->productInformation;
        $brandsCollection = $client->adminDB->brandInformation;
      	$usersCollection = $client->adminDB->userCredentials;
      	$Orderscollection = $client->adminDB->transactionInformation;

        $query=array();
        $cursor2=$collection->find(['previousOwner' => $_SESSION['userID'], 'status' => 'ACTIVE'],$query);

        foreach ($cursor2 as $doc) {
            $query = "INSERT IGNORE into productsbc (name, brand, userid, productid, quantity, price, description, dateadded, status) VALUES ('$doc[productName]', '$doc[brandName]', '$doc[previousOwner]', '$doc[productID]','$doc[productQuantity]', '$doc[productPrice]', '$doc[productDescription]','$doc[dateAdded]','active')";
                if(mysqli_query($conn, $query) == TRUE){
                }
                else{
                }
        }
      	
      	/* $Orderquery=array();
        $OrderMatch=$Orderscollection->find(['server' => 'YES'], $Orderquery);

        foreach ($OrderMatch as $docOrder) {
            $OrderSavequery = "INSERT IGNORE into orders (name, brand, sellerid, userid, productid, subquantity, subprice, status, fullname) VALUES ('$docOrder[productName]', '$docOrder[brandName]', '$docOrder[sellerID]', '$docOrder[buyerID]','$docOrder[productID]', '$docOrder[orderQuantity]','$docOrder[orderproductPrice]', '$docOrder[status]','$docOrder[buyerName]')";
                if(mysqli_query($conn, $OrderSavequery) == TRUE){
                }
                else{
                }
        } */

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
   $cursorUsers=$usersCollection->find(['user_PublicKey' => 'null'], $queryUsers);

   foreach ($cursorUsers as $docUsers) {
      $queryAddUsers = "INSERT IGNORE into users (email, code) VALUES ('$docUsers[user_email]', '$docUsers[user_resetCode]')";
          if(mysqli_query($conn, $queryAddUsers) == TRUE){
          }
          else{
          }
   }

        if($_SESSION['role'] == '2'){
            // echo "I AM A SELLER!";
            header("Location: ../kit/static/blockchain/seller/dashboard.php");
        }else if($_SESSION['role'] == '1'){
            // echo "I AM A BUYER";
            header("Location: ../kit/static/blockchain/buyer/");
        }
    }
?>




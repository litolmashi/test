
<?php
    session_start();
    ini_set('display_errors', 1);

    //$path = $_SERVER['DOCUMENT_ROOT'];
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $getBrandID = mysqli_real_escape_string($conn, $_POST['brandID']);
    $getBrandName = mysqli_real_escape_string($conn, $_POST['brandName']);
    $getOwner = mysqli_real_escape_string($conn, $_POST['owner']);
    $getDateCreated = mysqli_real_escape_string($conn, $_POST['date']);
    $getDescription = mysqli_real_escape_string($conn, $_POST['description']);
    $getUserID = mysqli_real_escape_string($conn, $_SESSION['userID']);
    $result = array();

    //$Mongopath = $_SERVER['DOCUMENT_ROOT'];
    $Mongopath = "/var/www/webroot/blockchainsys/config/";
    require_once($Mongopath.'vendor/autoload.php');

    $client = new MongoDB\Client(
       'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
    $collection = $client->adminDB->brandInformation;
    $brandCollection = $client->sellerDB->brandInformation;
	$brandCollectionServer = $client->adminDB->brandInformationServer;

    if(isset($_POST["submit"])){
        //BLOCKCHAIN SETTINGS

        //CHECKING FIRST IF THE BRAND NAME EXIST
		$query=array();
   		$checkName=$collection->find(['brandName' => $getBrandName],$query);

   		foreach ($checkName as $doc) {
			$getBlockBrandName = $doc['brandName'];
			// $getBlockPassword = $doc['user_password'];
   		}
		if($getBlockBrandName === $getBrandName){
            header('Location: ../blockchain/seller/Brands/AddBrandPage.php?result=3');
        }else{
            $insertOneResultAdmin = $collection->insertOne([
                'brandID' => $getBrandID,
                'brandName' => $getBrandName,
                'brandOwner' => $getOwner,
                'previousOwnerID' => $getUserID,
                'brandDescription' => $getDescription,
                'dateCreated' => $getDateCreated,
                'function' => 'CREATE',
                'lastActionDone' => 'Registered a new Brand',
                'status' => 'ACTIVE',
                'currentOwner' => $getOwner,
                'dateTransferred' => '',
                'currentOwnerID' => $getUserID,
                'display' => 'present',
              	'previousOwner' => $getOwner,
            ]);
            $insertOneResult = $brandCollection->insertOne([
                'brandID' => $getBrandID,
                'brandName' => $getBrandName,
                'brandOwner' => $getOwner,
                'previousOwnerID' => $getUserID,
                'brandDescription' => $getDescription,
                'dateCreated' => $getDateCreated,
                'function' => 'CREATE',
                'lastActionDone' => 'Registered a new Brand',
                'status' => 'ACTIVE',
                'currentOwner' => $getOwner,
                'dateTransferred' => '',
                'currentOwnerID' => $getUserID,
              	'previousOwner' => $getOwner,
            ]);
          	$insertOneResultServer = $brandCollectionServer->insertOne([
                'brandID' => $getBrandID,
                'brandName' => $getBrandName,
                'brandOwner' => $getOwner,
                'previousOwnerID' => $getUserID,
                'brandDescription' => $getDescription,
                'dateCreated' => $getDateCreated,
                'function' => 'CREATE',
                'lastActionDone' => 'Registered a new Brand',
                'status' => 'ACTIVE',
                'currentOwner' => $getOwner,
                'dateTransferred' => '',
                'currentOwnerID' => $getUserID,
                'previousOwner' => '',
            ]);
          	
            if ($insertOneResult == TRUE) {
                header('Location: ../blockchain/seller/Brands/AddBrandPage.php?result=1');
            }else{
                header('Location: ../blockchain/seller/Brands/AddBrandPage.php?result=2');
            }
        }

        //END OF BLOCKCHAIN SETTINGS
        // $query = "INSERT into products (productid, userid, brand, name, price, quantity, dateadded, blockID) VALUES ('$get_productID','$get_userID', '$get_brandName','$get_productName', '$get_productPrice','$get_productQuantity','$get_productDateAdded','$objectID')";
        // if(mysqli_query($conn, $query) == TRUE){
        // header('Location: ../blockchain/seller/Products/ProductPage.php?result=1');
        // }
        // else{
        // header('Location: ../blockchain/seller/Products/ProductPage.php?result=4');
        // }
    }
    $conn -> close();
?>



<?php
    session_start();
    ini_set('display_errors', 1);

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    date_default_timezone_set('Asia/Manila');
    $get_productID = mysqli_real_escape_string($conn, $_POST["productID"]);
    $get_brandName = mysqli_real_escape_string($conn, $_POST["brandName"]);
    $get_productName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $get_productPrice = mysqli_real_escape_string($conn, $_POST["productPrice"]);
    $get_productQuantity = mysqli_real_escape_string($conn, $_POST["productQuantity"]);
    $get_productDescription = mysqli_real_escape_string($conn, $_POST["description"]);
    $get_productDateAdded = mysqli_real_escape_string($conn, $_POST["productDateAdded"]);
    $get_userID = mysqli_real_escape_string($conn, $_POST["userID"]);
    $result = array();

    //BLOCKCHAIN SETTINGS
    $Mongopath = $_SERVER['DOCUMENT_ROOT'];
    $Mongopath .= "/blockchainsys/config/";
    require_once($Mongopath.'vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable($Mongopath);
    $dotenv->load();

    $client = new MongoDB\Client(
        'mongodb+srv://'.$_ENV['MDB_USER'].':'.$_ENV['MDB_PASS'].'@'.$_ENV['ATLAS_CLUSTER_SRV'].'/?retryWrites=true&w=majority&tls=true');
    $collection = $client->sellerDB->productInformation;
    $productCollection = $client->adminDB->productInformation;
    
    if(isset($_POST["submit"])){
        //BLOCKCHAIN SETTINGS

        //CHECKING FIRST IF THE BRAND NAME AND PRODUCT NAME EXIST
		$query=array();
   		$checkName=$collection->find(['previousOwner' => $_SESSION['userID']],$query);

   		foreach ($checkName as $doc) {
			$getBlockBrandName = $doc['brandName'];
			$getBlockProductName = $doc['productName'];
   		}
		if($getBlockBrandName === $get_brandName && $getBlockProductName === $get_productName){
            header('Location: ../blockchain/seller/Products/AddProductPage.php?result=6');
        }else{
            $insertOneResult = $collection->insertOne([
                'productID' => $get_productID,
                'brandName' => $get_brandName,
                'productName' => $get_productName,
                'productPrice' => $get_productPrice,
                'productQuantity' => $get_productQuantity,
                'productDescription' =>$get_productDescription,
                'dateAdded' => $get_productDateAdded,
                'function' => 'CREATE',
                'previousOwner' => $get_userID,
                'lastActionDone' => 'Added a new product',
                'version' => 'ORIGINAL',
                'status' => 'ACTIVE'
                ]);
            $insertOneResultAdmin = $productCollection->insertOne([
                'productID' => $get_productID,
                'brandName' => $get_brandName,
                'productName' => $get_productName,
                'productPrice' => $get_productPrice,
                'productQuantity' => $get_productQuantity,
                'productDescription' => $getDescription,
                'dateAdded' => $get_productDateAdded,
                'function' => 'CREATE',
                'previousOwner' => $get_userID,
                'lastActionDone' => 'Added a new product',
                'version' => 'ORIGINAL',
                'status' => 'ACTIVE'
            ]);
            if ($insertOneResult && $insertOneResultAdmin == TRUE) {
                header('Location: ../blockchain/seller/Products/AddProductPage.php?result=1');
            }else{
                header('Location: ../blockchain/seller/Products/AddProductPage.php?result=6');
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
    //END OF BLOCKCHAIN SETTINGS

    // if(isset($_POST["submit"])){
    //     $query = "INSERT into products (productid, userid, brand, name, price, quantity, dateadded, blockID) VALUES ('$get_productID','$get_userID', '$get_brandName','$get_productName', '$get_productPrice','$get_productQuantity','$get_productDateAdded','$objectID')";
    //     if(mysqli_query($conn, $query) == TRUE){
    //     header('Location: ../blockchain/seller/Products/ProductPage.php?result=1');
    //     }
    //     else{
    //     header('Location: ../blockchain/seller/Products/ProductPage.php?result=4');
    //     }
    // }
    $conn -> close();
?>
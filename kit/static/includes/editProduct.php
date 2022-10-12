<?php
    session_start();
    error_reporting();
    ini_set('display_errors', 1);
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/blockchainsys/config/db_config.php";
    include_once "/var/www/webroot/blockchainsys/config/db_config.php";
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $newconn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    
    $getProductID = $_GET["productid"];
    date_default_timezone_set('Asia/Manila');
    $getDate = date('M-d-Y: D, h:i:s');
    // $dataRes = $_POST['id'];
	$getBrand = mysqli_real_escape_string($conn, $_POST["brandName"]);
    $getName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $getPrice = mysqli_real_escape_string($conn, $_POST["productPrice"]);
    $getQuantity = mysqli_real_escape_string($conn, $_POST["productQuantity"]);
    $getDateAdded = mysqli_real_escape_string($conn, $_POST["productDateAdded"]);
    $get_userID = mysqli_real_escape_string($conn, $_POST["userID"]);
    $getDescription = mysqli_real_escape_string($conn, $_POST["description"]);
    //$newpath = $_SERVER['DOCUMENT_ROOT'];
    $newpath = "/var/www/webroot/blockchainsys/kit/static/blockchain/buyer/images";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $newpath.$fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    //BLOCKCHAIN SETTINGS
    $Mongopath = $_SERVER['DOCUMENT_ROOT'];
    $Mongopath .= "/blockchainsys/config/";
    //require_once($Mongopath.'vendor/autoload.php');
    //$dotenv = Dotenv\Dotenv::createImmutable($Mongopath);
    //$dotenv->load();
    $editID = uniqid();

    require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");
    
	$client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
    $collection = $client->sellerDB->productInformation;
    $productCollection = $client->adminDB->productInformation;
    $imageCollection = $client->sellerDB->productImageInformation;
    
    //END OF BLOCKCHAIN SETTINGS

    if(isset($_POST["submit"])){
        // $query= array();
        // $checkName=$collection->find(['previousOwner' => $_SESSION['userID'], 'productID' => $getID],$query);

   		// foreach ($checkName as $doc) {
		// 	$getBlockBrandName = $doc['brandName'];
		// 	$getBlockProductName = $doc['productName'];
   		// }
		// if($getBlockBrandName === $getBrand && $getBlockProductName === $getName){
            // header('Location: ../blockchain/seller/Products/EditProductPage.php?result=6');
        // }else{
            $updateResult = $collection->updateOne(
                [ 'productID' => $getProductID ],
                    [ '$set' => 
                        [
                            'brandName' => $getBrand,
                            'productName' => $getName,
                            'productPrice' => $getPrice,
                            'productQuantity' => $getQuantity,
                            'productDescription' => $getDescription,
                            'dateAdded' => $getDateAdded,
                            'function' => 'APPEND',
                            'lastActionDone' => 'UPDATE PRODUCT INFORMATION'
                        ],
                    ]
            );
            
            if($fileName == ''){
                $insertOneResult = $productCollection->insertOne([
                    'productID' => $getProductID,
                    'brandName' => $getBrand,
                    'productName' => $getName,
                    'productPrice' => $getPrice,
                    'productQuantity' => $getQuantity,
                    'productDescription' => $getDescription,
                    'dateAdded' => $getDateAdded,
                    'function' => 'APPEND',
                    'previousOwner' => $get_userID,
                    'lastActionDone' => 'UPDATE PRODUCT INFORMATION',
                    'status' => 'ACTIVE',
                    'dateEdited' => $getDate,
                    'version' => 'EDIT'
                ]);
                $query = "UPDATE
                    productsbc
                    SET
                    brand = '$getBrand',
                    name = '$getName',
                    price = '$getPrice',
                    quantity = '$getQuantity',
                    dateadded = '$getDateAdded',
                    description = '$getDescription'
                    WHERE
                    productid = '$getProductID'";
                if(mysqli_query($conn,$query) == TRUE){
                    header('Location: ../blockchain/seller/Products/ProductPage.php?result=5');
                }else{
                    header('Location: ../blockchain/seller/Products/ProductPage.php?result=8');
                }
            }else{
                $insertOneResult = $productCollection->insertOne([
                    'productID' => $getProductID,
                    'brandName' => $getBrand,
                    'productName' => $getName,
                    'productPrice' => $getPrice,
                    'productQuantity' => $getQuantity,
                    'productDescription' => $getDescription,
                    'dateAdded' => $getDateAdded,
                    'function' => 'APPEND',
                    'previousOwner' => $get_userID,
                    'lastActionDone' => 'UPDATE PRODUCT INFORMATION AND/OR ADDED NEW IMAGE',
                    'status' => 'ACTIVE',
                    'dateEdited' => $getDate,
                    'version' => 'EDIT'
                ]);
                $insertOneImageResult = $imageCollection->insertOne([
                    'productID' => $getProductID,
                    'brandName' => $getBrand,
                    'productName' => $getName,
                    'imageOne' => $fileName,
                    'dateAdded' => $getDateAdded,
                    'function' => 'CREATE',
                    'previousOwner' => $get_userID,
                    'lastActionDone' => 'Added a new product photo',
                    'status' => 'ACTIVE'
                ]);
                
                $query = "UPDATE
                    productsbc
                    SET
                    brand = '$getBrand',
                    name = '$getName',
                    price = '$getPrice',
                    quantity = '$getQuantity',
                    dateadded = '$getDateAdded',
                    description = '$getDescription'
                    WHERE
                    productid = '$getProductID'";
                if(mysqli_query($conn,$query) == TRUE){
                    $allowTypes = array('jpg','png','jpeg','gif','pdf','PNG','JPG','JPEG','GIF','PDF');
                    if(in_array($fileType, $allowTypes)){
                        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        }
                    }
                    header('Location: ../blockchain/seller/Products/ProductPage.php?result=5');
                }else{
                    header('Location: ../blockchain/seller/Products/ProductPage.php?result=6');
                }
            }
            
        // }
        // $result = array();
        // $query = "UPDATE
        //             products
        //           SET
        //             brand = '$getBrand',
        //             name = '$getName',
        //             price = '$getPrice',
        //             quantity = '$getQuantity',
        //             dateadded = '$getDateAdded'
        //           WHERE
        //             productid = '$getProductID'";
        // if(mysqli_query($conn,$query) == TRUE){
        //     }else{
        //     }
        // $allowTypes = array('jpg','png','jpeg','gif','pdf','PNG','JPG','JPEG','GIF','PDF');
        // if(in_array($fileType, $allowTypes)){
        //     if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
        //         header('Location: ../blockchain/seller/Products/ProductPage.php?result=5');
        //     }
        //     }
        //         $insert = $newconn->query ("INSERT into images (productID, filename) VALUES ('$getProductID', '".$fileName."')");
        //         if($insert){
        //             header('Location: ../blockchain/seller/Products/ProductPage.php?result=5');
        //         }else{
        //             header('Location: ../blockchain/seller/Products/ProductPage.php?result=6');
        //         } 
        //     }else{
        //         header('Location: ../blockchain/seller/Products/ProductPage.php?result=6');
        //     }
        // }else{
        //     header('Location: ../blockchain/seller/Products/ProductPage.php?result=7');
        // }
    }else{
        header('Location: ../blockchain/seller/Products/ProductPage.php?result=8');
    }
?>

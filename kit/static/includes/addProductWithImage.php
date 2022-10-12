<?php
    ini_set("session.cookie_httponly", True);
    ini_set('session.cookie_secure',true);
  
    // if(!isset($_SESSION['username'])){
    //     header("Location: /blockchainsys/index.php");
    // }
    // setcookie($_SESSION['username'], $_SESSION['nameType'], time()+ 3600,'/');

    session_start();
    ini_set('display_errors', 1);
    //$path = $_SERVER['DOCUMENT_ROOT'];
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $accessDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $newaccessDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    
    date_default_timezone_set('Asia/Manila');
    $get_productID = mysqli_real_escape_string($accessDB, $_POST['productID']);
    $get_brandName = mysqli_real_escape_string($accessDB, $_POST["brandName"]);
    $get_productName = mysqli_real_escape_string($accessDB, $_POST["productName"]);
    $get_productPrice = mysqli_real_escape_string($accessDB, $_POST["productPrice"]);
    $get_productQuantity = mysqli_real_escape_string($accessDB, $_POST["productQuantity"]);
    $get_productDateAdded = mysqli_real_escape_string($accessDB, $_POST["productDateAdded"]);
    $get_userID = mysqli_real_escape_string($accessDB, $_POST["userID"]);
    $getDescription = mysqli_real_escape_string($accessDB, $_POST["description"]);
    $getDate = date('m-d-Y h:i:s');
    //$newpath = $_SERVER['DOCUMENT_ROOT'];
    $newpath = "/var/www/webroot/blockchainsys/kit/static/blockchain/buyer/images/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $newpath . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    //BLOCKCHAIN SETTINGS
    //$Mongopath = $_SERVER['DOCUMENT_ROOT'];
    //$Mongopath .= "/blockchainsys/config/";
    //require_once($Mongopath.'vendor/autoload.php');
    //$dotenv = Dotenv\Dotenv::createImmutable($Mongopath);
    //$dotenv->load();

    require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");
	$client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
    $collection = $client->sellerDB->productInformation;
    $productCollection = $client->adminDB->productInformation;
    $imageCollection = $client->sellerDB->productImageInformation;
    
    // $objectID = sha1($insertOneResult->getInsertedId());
    //END OF BLOCKCHAIN SETTINGS

    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
      if($_SESSION['userID'] === "62baff74f0630"){
        $result = array();
        $query= array();
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
                'productDescription' => $getDescription,
                'dateAdded' => $get_productDateAdded,
                'function' => 'CREATE',
                'previousOwner' => $get_userID,
                'lastActionDone' => 'Added a new product',
                'version' => 'ORIGINAL',
                'status' => 'ACTIVE',
              	'verified' => 'DTI',
                'imageOne' => $fileName
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
              	'status' => 'ACTIVE',
                'verified' => 'DTI',
                'imageOne' => $fileName
            ]);
            $insertOneImageResult = $imageCollection->insertOne([
                'productID' => $get_productID,
                'brandName' => $get_brandName,
                'productName' => $get_productName,
                'imageOne' => $fileName,
                'dateAdded' => $get_productDateAdded,
                'function' => 'CREATE',
                'previousOwner' => $get_userID,
                'lastActionDone' => 'Added a new product photo',
              	'status' => 'ACTIVE',
                'verified' => 'DTI'
            ]);

            $allowTypes = array('jpg','png','jpeg','gif','pdf','PNG','JPG','JPEG','GIF','PDF');

            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    // $insert = $newaccessDB->query ("INSERT into images (productID, filename) VALUES ('$get_productID', '".$fileName."')");
                    // if($insert == TRUE){
                    //  header('Location: ../blockchain/seller/Products/AddProductPage.php?result=1');
                    // }else{
                        header('Location: ../blockchain/seller/Products/AddProductPage.php?result=2');
                    // } 
                }else{
                    header('Location: ../blockchain/seller/Products/AddProductPage.php?result=2');
                }
            }else{
                header('Location: ../blockchain/seller/Products/AddProductPage.php?result=3');
            }
            // if ($insertOneResult == TRUE) {
            //     header('Location: ../blockchain/seller/Products/AddProductPage.php?result=1');
            // }else{
            //     header('Location: ../blockchain/seller/Products/AddProductPage.php?result=6');
            // }
        }

        // $query = "INSERT into products (productid, userid, brand, name, price, quantity, description, dateadded, blockID) VALUES ('$get_productID','$get_userID','$get_brandName', '$get_productName','$get_productPrice', '$get_productQuantity', '$getDescription', '$get_productDateAdded','$objectID')";
        // if(mysqli_query($accessDB, $query) == TRUE){
            // header('Location: ../blockchain/seller/Products/ProductPage.php?result=1');
            
        // }
      }else{
        $result = array();
        $query= array();
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
                'productDescription' => $getDescription,
                'dateAdded' => $get_productDateAdded,
                'function' => 'CREATE',
                'previousOwner' => $get_userID,
                'lastActionDone' => 'Added a new product',
                'version' => 'ORIGINAL',
                'status' => 'ACTIVE',
                'verified' => 'DTI',
                'imageOne' => $fileName
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
                'status' => 'ACTIVE',
                'verified' => 'DTI',
                'imageOne' => $fileName
            ]);
            $insertOneImageResult = $imageCollection->insertOne([
                'productID' => $get_productID,
                'brandName' => $get_brandName,
                'productName' => $get_productName,
                'imageOne' => $fileName,
                'dateAdded' => $get_productDateAdded,
                'function' => 'CREATE',
                'previousOwner' => $get_userID,
                'lastActionDone' => 'Added a new product photo',
                'status' => 'ACTIVE',
                'verified' => 'DTI'
            ]);

            $allowTypes = array('jpg','png','jpeg','gif','pdf','PNG','JPG','JPEG','GIF','PDF');

            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    // $insert = $newaccessDB->query ("INSERT into images (productID, filename) VALUES ('$get_productID', '".$fileName."')");
                    // if($insert == TRUE){
                    //  header('Location: ../blockchain/seller/Products/AddProductPage.php?result=1');
                    // }else{
                        header('Location: ../blockchain/seller/Products/AddProductPage.php?result=2');
                    // } 
                }else{
                    header('Location: ../blockchain/seller/Products/AddProductPage.php?result=2');
                }
            }else{
                header('Location: ../blockchain/seller/Products/AddProductPage.php?result=3');
            }
            // if ($insertOneResult == TRUE) {
            //     header('Location: ../blockchain/seller/Products/AddProductPage.php?result=1');
            // }else{
            //     header('Location: ../blockchain/seller/Products/AddProductPage.php?result=6');
            // }
        }

        // $query = "INSERT into products (productid, userid, brand, name, price, quantity, description, dateadded, blockID) VALUES ('$get_productID','$get_userID','$get_brandName', '$get_productName','$get_productPrice', '$get_productQuantity', '$getDescription', '$get_productDateAdded','$objectID')";
        // if(mysqli_query($accessDB, $query) == TRUE){
            // header('Location: ../blockchain/seller/Products/ProductPage.php?result=1');
            
        // }
      }
    }else{
        header('Location: ../blockchain/seller/Products/ProductPage.php?result=4');
    }
	
    // if ($accessDB->connect_error) {
	// 	die("Connection failed: " . $accessDB->connect_error);
	// }
	echo $accessDB -> error;
?>



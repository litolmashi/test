
<?php
    session_start();
    ini_set('display_errors', 1);

    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('m-d-Y h:i:s a');
    $get_userID = mysqli_real_escape_string($conn, $_POST["userID"]);
    $get_productID = mysqli_real_escape_string($conn, $_POST["productID"]);
    $get_productPrice = mysqli_real_escape_string($conn, $_POST["productPrice"]);
    $get_productQuantity = mysqli_real_escape_string($conn, $_POST["productQuantity"]);
    $get_fullName = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $getSellerID = mysqli_real_escape_string($conn, $_POST["sellerid"]);
    $getBrand = mysqli_real_escape_string($conn, $_POST["getBrand"]);
    $getName = mysqli_real_escape_string($conn, $_POST["getName"]);
    
    $result = array();

    //BLOCKCHAIN SETTINGS
    $Mongopath = "/var/www/webroot/blockchainsys/config/";
    require_once($Mongopath.'vendor/autoload.php');

    $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
    $collection = $client->adminDB->transactionInformation;
    // $collectionHistory = $client->adminDB->transactionHistoryInformation;
    
    // $objectID = sha1($insertOneResult->getInsertedId());
    //END OF BLOCKCHAIN SETTINGS

    if(isset($_POST["submit"])){
        $insertOneResult = $collection->insertOne([
            'brandName' => $getBrand,
            'productName' => $getName,
            'sellerID' => $getSellerID,
            'buyerName' => $get_fullName,
            'buyerID' => $get_userID,
            'productID' => $get_productID,
            'orderproductPrice' => $get_productPrice,
            'orderQuantity' => $get_productQuantity,
            'dateCreated' => $currentDate,
            'function' => 'CREATE',
            'lastActionDone' => 'Added an item to cart',
            'status' => 'CART'
        ]);
        // $insertOneResultHistory = $collectionHistory->insertOne([
        //     'brandName' => $getBrand,
        //     'productName' => $getName,
        //     'sellerID' => $getSellerID,
        //     'buyerName' => $get_fullName,
        //     'buyerID' => $get_userID,
        //     'productID' => $get_productID,
        //     'orderproductPrice' => $get_productPrice,
        //     'orderQuantity' => $get_productQuantity,
        //     'dateOrder' => $currentDate,
        //     'function' => 'CREATE',
        //     'lastActionDone' => 'Added a new order',
        //     'status' => 'CART'
        // ]);
        // if($insertOneResult == TRUE){
        // header('Location: ../blockchain/buyer/cart.php?result=1');
        // }
        // else{
        //     header('Location: ../blockchain/buyer/cart.php?result=4');
        // }
        $query = "INSERT into orders (name, brand, sellerid, userid, productid, subquantity, subprice, status, fullname) VALUES ('$getName', '$getBrand', '$getSellerID', '$get_userID','$get_productID', '$get_productQuantity', '$get_productPrice','CART','$get_fullName')";
        if(mysqli_query($conn, $query) == TRUE){
        header('Location: ../blockchain/buyer/cart.php?result=1');
        }
        else{
            header('Location: ../blockchain/buyer/cart.php?result=2');
        }
        // echo $get_userID;
        // echo "<br>";
        // echo $get_productID;
        // echo "<br>";
        // echo $get_productPrice;
        // echo "<br>";
        // echo $get_productQuantity;
        // echo "<br>";
        // echo $get_fullName;
    }
    $conn -> close();
?>



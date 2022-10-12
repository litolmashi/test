<?php
    session_start();
    error_reporting();
    ini_set('display_errors', 1);
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $newconn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    
    $getOrderIDNow = $_GET["orderid"];
    $getPrLocal = "SELECT * FROM orders WHERE id='$getOrderIDNow'";
							$resultID = $conn->query($getPrLocal);

							if ($resultID->num_rows > 0) {
								while($GetrowID = $resultID->fetch_assoc()) {
                                    $getBrand = $GetrowID['brand'];
                                    $getName = $GetrowID['name'];
                                    $getSellerID = $GetrowID['sellerid'];
                                    $getfullName = $GetrowID['fullname'];
                                    $getuserID = $GetrowID['userid'];
                                    $getProductID = $GetrowID['productid'];
                                    $get_productPrice = $GetrowID['subprice'];
                                    $getQuantity = $GetrowID['subquantity'];
								}
							}
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('m-d-Y h:i:s a');

    //BLOCKCHAIN SETTINGS
    $Mongopath = "/var/www/webroot/blockchainsys/config/";
    require_once($Mongopath.'vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable($Mongopath);
    $dotenv->load();

    $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
    $collection = $client->adminDB->transactionInformation;
    //END OF BLOCKCHAIN SETTINGS

    // if(isset($_POST["submit"])){
        $insertOneResult = $collection->insertOne([
            'brandName' => $getBrand,
            'productName' => $getName,
            'sellerID' => $getSellerID,
            'buyerName' => $getfullName,
            'buyerID' => $getuserID,
            'productID' => $getProductID,
            'orderproductPrice' => $get_productPrice,
            'orderQuantity' => $getQuantity,
            'dateCreated' => $currentDate,
            'function' => 'DELETE',
            'lastActionDone' => 'Cancel an order',
            'status' => 'ORDER CANCELLED',
            'orderid' => $getOrderIDNow
        ]);
    //END OF BLOCKCHAIN SETTINGS

    // if(isset($_POST["submit"])){
        $result = array();
        $query = "UPDATE
                    orders
                  SET
                    status = 'CANCELLED',
                    cancelDate = '$currentDate'
                  WHERE
                    id = '$getOrderIDNow'";
        if(mysqli_query($conn,$query) == TRUE){
            header('Location: ../blockchain/buyer/pending.php?result=3');
        }else{
            header('Location: ../blockchain/buyer/pending.php?result=2');
        }
    // }else{
    //     header('Location: ../blockchain/buyer/cart.php?result=4');
    // }
?>


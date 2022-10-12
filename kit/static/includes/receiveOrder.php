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
                                    $getBuyerID = $GetrowID['userid'];
                                    $getfullName = $GetrowID['fullname'];
                                    $getuserID = $GetrowID['sellerid'];
                                    $getProductID = $GetrowID['productid'];
                                    $get_productPrice = $GetrowID['subprice'];
                                    $getQuantity = $GetrowID['subquantity'];
								}
							}
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('m-d-Y h:i:s a');
    $Mongopath = "/var/www/webroot/blockchainsys/config/";
    require_once($Mongopath.'vendor/autoload.php');

    $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
    $collection = $client->adminDB->transactionInformation;
    //END OF BLOCKCHAIN SETTINGS

    // if(isset($_POST["submit"])){
        $insertOneResult = $collection->insertOne([
            'brandName' => $getBrand,
            'productName' => $getName,
            'sellerID' => $getuserID,
            'buyerName' => $getfullName,
            'buyerID' => $getBuyerID,
            'productID' => $getProductID,
            'orderproductPrice' => $get_productPrice,
            'orderQuantity' => $getQuantity,
            'dateCreated' => $currentDate,
            'function' => 'CREATE',
            'lastActionDone' => 'Order received by buyer',
            'status' => 'ORDER RECEIVED',
            'orderid' => $getOrderIDNow
        ]);
    //END OF BLOCKCHAIN SETTINGS

    // if(isset($_POST["submit"])){
        $result = array();
        $query = "UPDATE
                    orders
                  SET
                    status = 'COMPLETED',
                    receivedDate = '$currentDate'
                  WHERE
                    id = '$getOrderIDNow'";
        if(mysqli_query($conn,$query) == TRUE){
            header('Location: ../blockchain/buyer/shipping.php?result=1');
        }else{
            header('Location: ../blockchain/buyer/shipping.php?result=2');
        }
    // }else{
    //     header('Location: ../blockchain/buyer/cart.php?result=4');
    // }
?>


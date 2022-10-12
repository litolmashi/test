<?php
    session_start();
    error_reporting();
    ini_set('display_errors', 1);
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $newconn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    
    $getProductID = $_GET["productid"];
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('m-d-Y h:i:s a');
    $getDate = date('m-d-Y h:i:s a');
    $getPrice = $_POST["grandTotal"];
    $getQuantity = $_POST["productQuantity"];
    $getuserID = $_SESSION['userID'];
    $getfullName = $_SESSION['name'];
    $getAddress = $_POST["address"].", ".$_POST["city"].", ".$_POST["province"].", ".$_POST["country"].", ".$_POST["postcode"];
    $getPayment = $_POST["payment"];
    $getDelivery = $_POST["delivery"];
    $getOrderid = $_POST['orderID'];
    $getBrand = $_POST['brandName'];
    $getName = $_POST['productName'];
    $getSellerID = $_POST['sellerID'];
    $get_productPrice = $_POST['productPriceShow'];
	$get_email = $_POST['email'];
	$get_phone = $_POST['phone'];
	$get_notes = $_POST['notes'];

	/*if(isset($_POST["submit"])){
      echo $getProductID;
      echo "<br>";
echo $currentDate;
      echo "<br>";
echo $getDate;
      echo "<br>";
echo $getPrice;
      echo "<br>";
echo $getQuantity;
      echo "<br>";
echo $getuserID;
      echo "<br>";
echo $getfullName;
      echo "<br>";
echo $getAddress;
      echo "<br>";
echo $getPayment;
      echo "<br>";
echo $getDelivery;
      echo "<br>";
echo $getOrderid;
      echo "<br>";
echo $getBrand;
      echo "<br>";
echo $getName;
      echo "<br>";
echo $getSellerID;
      echo "<br>";
echo $get_productPrice;
      echo "<br>";
      echo $get_email;
      echo "<br>";
echo $get_phone;
      echo "<br>";
echo $get_notes;
      echo "<br>";
    } */

    //BLOCKCHAIN SETTINGS
    $Mongopath = "/var/www/webroot//blockchainsys/config/";
    require_once($Mongopath.'vendor/autoload.php');

    $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
    $collection = $client->adminDB->transactionInformation;
    //END OF BLOCKCHAIN SETTINGS

    if(isset($_POST["submit"])){
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
            'function' => 'CREATE',
            'lastActionDone' => 'Added a new order',
            'status' => 'CHECKOUT, WAITING FOR CONFIRMATION',
            'orderid' => $getOrderid,
            'email' => $get_email,
            'phone' => $get_phone,
            'notes' => $get_notes
        ]);
        $result = array();
        $query = "UPDATE
                    orders
                  SET
                    price = '$getPrice',
                    quantity = '$getQuantity',
                    orderdate = '$getDate',
                    address = '$getAddress',
                    status = 'WAITING FOR CONFIRMATION',
                    userid = '$getuserID',
                    fullname = '$getfullName',
                    delivery = '$getDelivery',
                    payment = '$getPayment',
                    email = '$get_email',
                    phone = '$get_phone',
                    notes = '$get_notes'
                  WHERE
                    id = '$getOrderid'";
        if(mysqli_query($conn,$query) == TRUE){
            header('Location: ../blockchain/buyer/pending.php?result=1');
        }else{
            header('Location: ../blockchain/buyer/pending.php?result=2');
        }
    }else{
        header('Location: ../blockchain/buyer/pending.php?result=2');
    }
?>



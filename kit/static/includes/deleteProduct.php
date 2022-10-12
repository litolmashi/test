<?php
    session_start();
    ini_set('display_errors', 1);
    //$path = $_SERVER['DOCUMENT_ROOT'];
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $deleteconn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    
    $getProductID = $_GET["productid"];

    //BLOCKCHAIN SETTINGS
    //$Mongopath = $_SERVER['DOCUMENT_ROOT'];
    $Mongopath = "/var/www/webroot//blockchainsys/config/";
    require_once($Mongopath.'vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable($Mongopath);
    $dotenv->load();
    $deleteID = uniqid();
    date_default_timezone_set('Asia/Manila');
    $getDate = date('M-d-Y: D, h:i:s');

    $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
    $collection = $client->sellerDB->productInformation;
    $productCollection = $client->adminDB->productInformation;
    $imageCollection = $client->sellerDB->productImageInformation;
    
    $updateResult = $collection->updateOne(
        [ 'productID' => $getProductID ],
            [ '$set' => 
                [
                    'function' => 'BURN',
                    'lastActionDone' => 'DELETE PRODUCT INFORMATION',
                    'status' => 'DELETED',
                    'dateDeleted' => $getDate
                ],
            ]
    );
    $insertOneResult = $productCollection->insertOne([
        'productID' => $getProductID,
        'function' => 'BURN',
        'previousOwner' => $_SESSION['userID'],
        'lastActionDone' => 'DELETE PRODUCT INFORMATION',
        'status' => 'ONLY IN BLOCKCHAIN',
        'dateDeleted' => $getDate,
        'version' => 'DELETE'
    ]);
    $updateImageResult = $imageCollection->updateOne(
        [ 'productID' => $getProductID ],
            [ '$set' => 
                [
                    'function' => 'BURN',
                    'lastActionDone' => 'DELETE PRODUCT PHOTO',
                    'status' => 'DELETED',
                    'dateDeleted' => $getDate
                ],
            ]
    );
    // $delete = mysqli_query($conn,"DROP TABLE productsbc");
    $queryUpdate = "UPDATE
                    productsbc
                    SET
                    status = 'deleted'
                    WHERE
                    productid = '$getProductID'";
          if(mysqli_query($conn, $queryUpdate) == TRUE){
            header('Location: ../blockchain/seller/Products/ProductPage.php?result=9');
          }
          else{
            header('Location: ../blockchain/seller/Products/ProductPage.php?result=10');
          }
    // if($insertOneResult == TRUE){
    //     header('Location: ../blockchain/seller/Products/ProductPage.php?result=9');
    // }else{
    //     header('Location: ../blockchain/seller/Products/ProductPage.php?result=10');
    // }
    // $updateResult = $collection->updateOne(
    //     [ 'productID' => $getProductID ],
    //         [ '$set' => 
    //             [
    //                 'lastActionDone' => 'DELETED PRODUCT ON LOCAL DATABASE',
    //                 'sVersion' => $deleteID,
    //                 'dateOfDeletion' => $getDate,
    //                 'sfunction' => 'APPEND',
    //                 'sStatus' => 'INFORMATION ONLY EXIST ON BLOCKCHAIN.',
    //             ]
    //         ]
    // );
    //END OF BLOCKCHAIN SETTINGS

    // $delete = mysqli_query($conn,"DELETE FROM products WHERE productid = '$getProductID'");
    // $deleteimg = mysqli_query($deleteconn,"DELETE FROM images WHERE productID = '$getProductID'");

 

    // if($delete){
    //     header('Location: ../blockchain/seller/Products/ProductPage.php?result=9');
    // }else{
    //     header('Location: ../blockchain/seller/Products/ProductPage.php?result=10');
    // }
    // if($deleteimg){
    //     header('Location: ../blockchain/seller/Products/ProductPage.php?result=9');
    // }else{
    //     header('Location: ../blockchain/seller/Products/ProductPage.php?result=10');
    // }
?>

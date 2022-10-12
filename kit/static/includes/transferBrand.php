
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
    $getTransfer = mysqli_real_escape_string($conn, $_POST['transfer']);
    $getDateTransfer = mysqli_real_escape_string($conn, $_POST['transferdate']);
    $result = array();

    //$Mongopath = $_SERVER['DOCUMENT_ROOT'];
    $Mongopath = "/var/www/webroot/blockchainsys/config/";
    require_once($Mongopath.'vendor/autoload.php');
    //$dotenv = Dotenv\Dotenv::createImmutable($Mongopath);
    //$dotenv->load();

    $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
    $collection = $client->adminDB->brandInformation;
    $brandCollection = $client->sellerDB->brandInformation;
	$brandCollectionServer = $client->sellerDB->brandInformationServer;
	$collectionServer = $client->adminDB->brandInformationServer;

    if(isset($_POST["submit"])){
        echo $getTransfer;
        //BLOCKCHAIN SETTINGS

        //CHECKING FIRST IF THE BRAND NAME EXIST
		// $query=array();
   		// $checkName=$collection->find(['brandName' => $getBrandName],$query);

   		// foreach ($checkName as $doc) {
		// 	$getBlockBrandName = $doc['brandName'];
		// 	// $getBlockPassword = $doc['user_password'];
   		// }
		// if($getBlockBrandName === $getBrandName){
        //     header('Location: ../blockchain/seller/Brands/AddBrandPage.php?result=3');
        // }else{
            $insertOneResultAdmin = $collection->insertOne([
                'brandID' => $getBrandID,
                'brandName' => $getBrandName,
                'brandOwner' => $getOwner,
                'previousOwnerID' => $getUserID,
                'brandDescription' => $getDescription,
                'dateCreated' => $getDateCreated,
                'function' => 'TRANSFER',
                'lastActionDone' => 'Transfer Brand',
                'status' => 'ACTIVE',
                'currentOwner' => $getTransfer,
                'dateTransferred' => $getDateTransfer,
                'currentOwnerID' => '',
                'previousOwner' => $getOwner,
            ]);
            $updateResult = $collection->updateOne(
                [ 'brandID' => $getBrandID ],
                    [ '$set' => 
                        [
                            'display' => 'none',
                        ],
                    ]
            );
      		$updateResultServer = $collectionServer->updateOne(
                [ 'brandID' => $getBrandID ],
                    [ '$set' => 
                        [
                            'display' => 'none',
                          	'currentOwner' => $getTransfer,
                          	'previousOwner' => $getOwner,
                          	'dateTransferred' => $getDateTransfer,
                        ],
                    ]
            );
            // $insertOneResult = $brandCollection->insertOne([
            //     'brandID' => $getBrandID,
            //     'brandName' => $getBrandName,
            //     'brandOwner' => $getOwner,
            //     'previousOwnerID' => $getUserID,
            //     'brandDescription' => $getDescription,
            //     'dateCreated' => $getDateCreated,
            //     'function' => 'CREATE',
            //     'lastActionDone' => 'Registered a new Brand',
            //     'status' => 'ACTIVE',
            //     'currentOwner' => $getOwner,
            //     'dateTransferred' => '',
            //     'currentOwnerID' => $getUserID,
            //     'previousOwner' => $getOwner,
            // ]);
            if ($insertOneResultAdmin == TRUE) {
                header('Location: ../blockchain/seller/Brands/BrandPage.php?result=4');
            }else{
                header('Location: ../blockchain/seller/Brands/BrandPage.php?result=5');
            }
        // }

        //END OF BLOCKCHAIN SETTINGS
        // $query = "UPDATE
        //             brandsbc
        //             SET
        //             previousowner = '$getOwner'
        //             -- currentowner = '$getTransfer',
        //             -- datetransferred = '$getDateTransfer'
        //             WHERE
        //             brandid = '$getBrandID'";
        // if(mysqli_query($conn, $query) == TRUE){
        // // header('Location: ../blockchain/seller/Products/ProductPage.php?result=1');
        // header('Location: ../blockchain/seller/Brands/TransferBrandPage.php?result=1');
        // }
        // else{
        // // header('Location: ../blockchain/seller/Products/ProductPage.php?result=4');
        // header('Location: ../blockchain/seller/Brands/TransferBrandPage.php?result=2');
        // }
    }
    $conn -> close();
?>


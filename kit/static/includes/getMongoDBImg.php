<?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path = "/var/www/webroot/blockchainsys/config/";

        require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");

        //$dotenv = Dotenv\Dotenv::createImmutable($path);
        //$dotenv->load();
        

        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
        $collection = $client->sellerDB->productImageInformation;

        $query=array();
        $getImgNames=$collection->find(['previousOwner' => $_SESSION['userID'], 'productID' => $getID],$query);

        foreach ($getImgNames as $doc) {
            $imageName = $doc['imageOne'];
            $imageSource = "/blockchainsys/kit/static/blockchain/buyer/images/".$imageName;
            echo '
            <center>
            <img src="'.$imageSource.'" width="50%">
            </center>
            <br>
            ';
        }
?>


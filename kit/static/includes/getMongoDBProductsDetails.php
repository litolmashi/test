<?php
        $path = "/var/www/webroot/blockchainsys/config/";

        require_once($path.'vendor/autoload.php');

        $dotenv = Dotenv\Dotenv::createImmutable($path);
        $dotenv->load();
        

        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
        $collection = $client->sellerDB->productInformation;
        $collectionImg = $client->sellerDB->productImageInformation;

        $query=array();
        $queryImg=array();
        $getImgNames=$collection->find(['status' => 'ACTIVE', 'productID' => $productID],$query);
        $getProductImgNames=$collectionImg->find(['productID' => $productID],$queryImg);

        foreach ($getImgNames as $doc) {
            $imageName = $doc['imageOne'];
            $imageSource = "/blockchainsys/kit/static/blockchain/buyer/images/".$imageName;
        }
        foreach ($getProductImgNames as $docImg) {
            $imageNameB = $docImg['imageOne'];
            $imageSourceB = "/blockchainsys/kit/static/blockchain/buyer/images/".$imageNameB;
            echo '
                <div class="small-img-col">
                    <img src="'.$imageSourceB.'" width="100%" class="small-img">
                </div>
            ';
        }
?>

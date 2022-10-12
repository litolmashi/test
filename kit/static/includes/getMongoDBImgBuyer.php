<?php
        $path = "/var/www/webroot/blockchainsys/config/";

        require_once($path.'vendor/autoload.php');
        

        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
        $collection = $client->sellerDB->productImageInformation;

        $query=array();
        $getImgNames=$collection->find(['productID' => $getID],$query);

        foreach ($getImgNames as $doc) {
            $imageName = $doc['imageOne'];
            $imageSource = "/blockchainsys/kit/static/blockchain/buyer/images/".$imageName;
            echo '
            <div class="col-12 col-md-6 col-lg-3">
							<div class="card">
								<img class="img-fluid pe-2" src="'.$imageSource.'" alt="Unsplash">
							</div>
						</div>';
        }
?>

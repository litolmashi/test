<?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/blockchainsys/config/";

        require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");

        //$dotenv = Dotenv\Dotenv::createImmutable($path);
        //$dotenv->load();
        

        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
        $collection = $client->sellerDB->productInformation;

        $query=array();
        $getImgNames=$collection->find(['status' => 'ACTIVE'],$query);

        foreach ($getImgNames as $doc) {
            $imageName = $doc['imageOne'];
            $imageSource = "/blockchainsys/kit/static/blockchain/buyer/images/".$imageName;
            echo '
                <div class="col-md-3 mb-2">
                <div class="text-center" style=" margin-left:42px;">
                    <div  class="col-4">
                        <a href="/blockchainsys/kit/static/blockchain/buyer/productdetails.php?productID=';echo $doc['productID'];echo '" style="text-decoration:none;">
                            <div class="border-secondary">
                                <img src="'; echo $imageSource; echo '" class="card-img-top" width="50%">'; echo '
                                <div class="card-body">
                                    <h6 class=" text-center">Price: ';echo $doc['productPrice']; echo'</h6>
                                    <h4 style="margin: top 100px;"class=" text-center rounded p-1">'; echo  $doc['productName'];  echo ' </h4>
                                    <h6 style="margin: top 100px;"class=" text-center rounded p-1">'; echo  $doc['brandName'];  echo ' </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    </div>
                </div> 
            ';
        }
?>




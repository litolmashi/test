<?php
        //$path = $_SERVER['DOCUMENT_ROOT'];
        $path = "/var/www/webroot/blockchainsys/config/";
        // echo $_GET['productid'];

        require_once($path.'vendor/autoload.php');


        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
        $collection = $client->adminDB->productInformation;

        $query=array();
        $getBrandNames=$collection->find(['productID' => $_GET['productid']],$query);

        foreach ($getBrandNames as $doc) {
            echo "
                <tr>
                    <td>$doc[brandName]</td>
                    <td>$doc[productName]</td>
                    <td>$doc[productPrice]</td>
                    <td>$doc[productQuantity]</td>
                    <td>$doc[productDescription]</td>
                    <td>$doc[dateAdded]</td>
                    <td>$doc[function]</td>
                    <td>$doc[lastActionDone]</td>
                    <td>$doc[version]</td>
                    <td>$doc[status]</td>
                </tr>
            ";
        }
?>

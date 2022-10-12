<?php
        $path = "/var/www/webroot/blockchainsys/config/";
        // echo $_GET['productid'];
        //ini_set('display_errors', 1);
        require_once($path.'vendor/autoload.php');

        $dotenv = Dotenv\Dotenv::createImmutable($path);
        $dotenv->load();

        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
        $collection = $client->adminDB->transactionInformation;

        $query=array();
        $getBrandNames=$collection->find(['sellerID' => $_SESSION['userID']],$query);

        foreach ($getBrandNames as $doc) {
            $total = intval($doc['orderQuantity']) * intval($doc['orderproductPrice']);
            $orderID = substr(sha1($doc['_id']), 0, 16);
            $userID = $doc['buyerID'];
            echo "
                <tr>
                    <td>$doc[lastActionDone]</td>
                    <td>$orderID</td>
                    <td>$userID</td>
                    <td>$doc[productName]</td>
                    <td>$doc[brandName]</td>
                    <td>$doc[orderQuantity]</td>
                    <td>Php $doc[orderproductPrice]</td>
                    <td>Php $total</td>
                    <td>$doc[dateCreated]</td>
                </tr>
            ";
        }
?>


<?php
        $path = "/var/www/webroot/blockchainsys/config/";
        // echo $_GET['productid'];

        require_once($path.'vendor/autoload.php');

        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
        $collection = $client->adminDB->transactionInformation;

        $query=array();
        $getBrandNames=$collection->find(['buyerID' => $_SESSION['userID']],$query);

        foreach ($getBrandNames as $doc) {
            $total = intval($doc['orderQuantity']) * intval($doc['orderproductPrice']);
            $orderID = substr(sha1($doc['_id']), 0, 16);
            echo "
                <tr>
                    <td>$doc[lastActionDone]</td>
                    <td>$orderID</td>
                    <td>$doc[productName]</td>
                    <td>$doc[brandName]</td>
                    <td>$doc[orderQuantity]</td>
                    <td>Php $doc[orderproductPrice]</td>
                    <td>Php $total</td>
                    <td>$doc[dateCreated]</td>
                </tr>
            ";
        }
        $queryAdmin=array();
        $getBrandNamesAdmin=$collection->find(['lastActionDone' => 'Cancel/Rejected order by seller', 'buyerID' => $_SESSION['userID']],$queryAdmin);

        echo "
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            ";

        foreach ($getBrandNamesAdmin as $docAdmin) {
            $total = intval($docAdmin['orderQuantity']) * intval($docAdmin['orderproductPrice']);
            $orderID = substr(sha1($docAdmin['_id']), 0, 16);
            echo "
                <tr>
                    <td>$docAdmin[lastActionDone]</td>
                    <td>$orderID</td>
                    <td>$docAdmin[productName]</td>
                    <td>$docAdmin[brandName]</td>
                    <td>$docAdmin[orderQuantity]</td>
                    <td>Php $docAdmin[orderproductPrice]</td>
                    <td>Php $total</td>
                    <td>$docAdmin[dateCreated]</td>
                </tr>
            ";
        }

        $queryAdminAgain=array();
        $getBrandNamesAdminAgain=$collection->find(['lastActionDone' => 'Shipped order by seller', 'buyerID' => $_SESSION['userID']],$queryAdminAgain);

        echo "
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            ";
        
        foreach ($getBrandNamesAdminAgain as $docAdminAgain) {
            $total = intval($docAdminAgain['orderQuantity']) * intval($docAdminAgain['orderproductPrice']);
            $orderID = substr(sha1($docAdminAgain['_id']), 0, 16);
            echo "
                <tr>
                    <td>$docAdminAgain[lastActionDone]</td>
                    <td>$orderID</td>
                    <td>$docAdminAgain[productName]</td>
                    <td>$docAdminAgain[brandName]</td>
                    <td>$docAdminAgain[orderQuantity]</td>
                    <td>Php $docAdminAgain[orderproductPrice]</td>
                    <td>Php $total</td>
                    <td>$docAdminAgain[dateCreated]</td>
                </tr>
            ";
        }

        // $queryAdminAgainNew=array();
        // $getBrandNamesAdminAgainNew=$collection->find(['lastActionDone' => 'Order received by buyer'],$queryAdminAgainNew);

        // echo "
        //         <tr>
        //             <td></td>
        //             <td></td>
        //             <td></td>
        //             <td></td>
        //             <td></td>
        //             <td></td>
        //             <td></td>
        //             <td></td>
        //         </tr>
        //     ";
        
        // foreach ($getBrandNamesAdminAgainNew as $docAdminAgainNew) {
        //     $total = intval($docAdminAgain['orderQuantity']) * intval($docAdminAgainNew['orderproductPrice']);
        //     $orderID = substr(sha1($docAdminAgainNew['_id']), 0, 16);
        //     echo "
        //         <tr>
        //             <td>$docAdminAgainNew[lastActionDone]</td>
        //             <td>$orderID</td>
        //             <td>$docAdminAgainNew[productName]</td>
        //             <td>$docAdminAgainNew[brandName]</td>
        //             <td>$docAdminAgainNew[orderQuantity]</td>
        //             <td>Php $docAdminAgainNew[orderproductPrice]</td>
        //             <td>Php $total</td>
        //             <td>$docAdminAgainNew[dateCreated]</td>
        //         </tr>
        //     ";
        // }
?>


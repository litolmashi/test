<?php
ini_set('display_errors', 1);
require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");
$mongo      = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
$collection = $mongo->adminDB->brandInformationServer;

$query=array();
   $resultSet=$collection->find(['previousOwner' => $_SESSION['name']],$query);

    foreach ($resultSet as $item) {
      	echo '
        	<tr>
                    <td>'.$item['brandID'].'</td>
                    <td>'.$item['brandName'].'</td>
                    <td>'.$item['brandDescription'].'</td>
                    <td>'.$item['dateCreated'].'</td>
                    <td>'.$item['previousOwner'].'</td>
                    <td>'.$item['currentOwner'].'</td>
                    <td>'.$item['dateTransferred'].'</td>
                </tr>';
        
    }
?>



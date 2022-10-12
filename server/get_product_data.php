<?php
ini_set('display_errors', 1);
require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");
$mongo      = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
$collection = $mongo->sellerDB->productInformation;

$query=array();
   $resultSet=$collection->find(['previousOwner' => $_SESSION['userID'], 'status' => 'ACTIVE'],$query);

    foreach ($resultSet as $item) {
      	echo '
        	<tr>
                    <td>'.$item['productID'].'</td>
                    <td>'.$item['brandName'].'</td>
                    <td>'.$item['productName'].'</td>
                    <td>'.$item['productPrice'].'</td>
                    <td>'.$item['productQuantity'].'</td>
                    <td>'.$item['dateAdded'].'</td>
                    <td><b title="View Information"><div class="row mt-1"><button class="btn btn-info btn-xl"><a href="viewHistoryProducts.php?productid='.$item['productID'].'" style="color:white;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="lightgreen" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> View</a></button></div></td>
                </tr>';
        
    }
        //$k++;
    


//var_dump($rec);

//exit;

?>





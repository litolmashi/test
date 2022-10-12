<?php
ini_set('display_errors', 1);
require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");
$mongo      = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
$collection = $mongo->adminDB->brandInformationServer;

$query=array();
   $resultSet=$collection->find(['currentOwner' => $_SESSION['name']],$query);

    foreach ($resultSet as $item) {
      	echo '
        	<tr>
                    <td>'.$item['brandID'].'</td>
                    <td>'.$item['brandName'].'</td>
                    <td>'.$item['brandDescription'].'</td>
                    <td>'.$item['dateCreated'].'</td>
                    <td><b title="Transfer"><div class="row mt-1"><button class="btn btn-info btn-xl"><a href="TransferBrandPage.php?brandID='.$item["brandID"].'" style="color:white;" onclick=myAlert()><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="lightgreen" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> Transfer</a></button></div></td>
                </tr>';
        
    }
        //$k++;
    


//var_dump($rec);

//exit;

?>




<?php
ini_set('display_errors', 1);
require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");
$mongo      = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
$collection = $mongo->sellerDB->productInformation;
//$database   = $mongo->selectDb('sellerDB');
//$collection = $database->selectCollection('productInformation');
//var_dump($collection);


//$skip       = (int)$_REQUEST['iDisplayStart'];
//$limit      = (int)$_REQUEST['iDisplayLength'];
//$search     = $_REQUEST['sSearch'];
//$sortIndex  = $_REQUEST['iSortCol_0'];

//$sortArray  = array('productName', 'brandName', 'previousOwner', 'productID', 'productQuantity', 'productPrice', 'productDescription', 'dateAdded', 'status'
//);

//$sortByCol  = $sortArray[$sortIndex];
//$sortTypeTxt= $_REQUEST['sSortDir_0'];  // asc/desc

//$sortType = -1;
//if( $sortTypeTxt == 'asc' )
//{
//    $sortType = 1;
//}


$data = array();
//$query=array();
   $resultSet=$collection->find(['previousOwner' => $_SESSION['userID'], 'status' => 'ACTIVE'],$data);

    foreach ($resultSet as $item) {
      	echo '
        	<tr>
                    <td>'.$item['productID'].'</td>
                    <td>'.$item['brandName'].'</td>
                    <td>'.$item['productName'].'</td>
                    <td>'.$item['productPrice'].'</td>
                    <td>'.$item['productQuantity'].'</td>
                    <td>'.$item['dateAdded'].'</td>
                    <td><b title="Edit Information"><div class="row mt-1"><button class="btn btn-info btn-xl"><a href="editProductPage.php?productid='.$item['productID'].'" style="color:white;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="lightgreen" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> Edit</a></button></div><b title="Delete Record"><div class="row mt-1"><button class="btn btn-info btn-xl"><a href="/blockchainsys/kit/static/includes/deleteProduct.php?productid='.$item['productID'].'" onclick="myAlert()")" style="color:white;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Delete</a></button></div></td>
                </tr>';
        
    }
        //$k++;
    


//var_dump($rec);

//exit;

?>


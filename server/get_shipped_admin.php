<?php
	ini_set('display_errors', 1);
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$id = $_SESSION['userID'];
	
	$sql = "SELECT * FROM orders WHERE sellerid = '$id' && status = 'SHIPPED'";
	$result = $conn->query($sql);
	foreach ($result as $item){
      echo'
      	<tr>
                    <td>'.$item['id'].'</td>
                    <td>'.$item['productid'].'</td>
                    <td>'.$item['quantity'].'</td>
                    <td>'.$item['fullname'].'</td>
                    <td>'.$item['price'].'</td>
                    <td>'.$item['orderdate'].'</td>
                    <td>'.$item['delivery'].'</td>
                    <td>'.$item['status'].'</td>
                    <td>'.$item['shippedDate'].'</td>
                    <td><b title="View Order Status"><div class="col-12 mt-1"><button class="btn btn-info btn-xl"><a href="/blockchainsys/kit/static/includes/viewOrder.php?productid='.$item['id'].'" style="color:white;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> View Status Order</a></button><div></td>
                </tr>';
    }
?>

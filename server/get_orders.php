<?php
	ini_set('display_errors', 1);
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$id = $_SESSION['userID'];
	
	$sql = "SELECT * FROM orders WHERE status='WAITING FOR CONFIRMATION' AND sellerid = '$id'";
	$result = $conn->query($sql);
	foreach ($result as $item){
      echo'
      	<tr>
                    <td>'.$item['id'].'</td>
                    <td>'.$item['productid'].'</td>
                    <td>'.$item['subquantity'].'</td>
                    <td>'.$item['fullname'].'</td>
                    <td>'.$item['subprice'].'</td>
                    <td>'.$item['orderdate'].'</td>
                    <td>'.$item['address'].'</td>
                    <td>'.$item['status'].'</td>
                    <td><b title="Ship Order"><div class="row"><button class="btn btn-info btn-xl"><a href="/blockchainsys/kit/static/includes/checkoutOrderAdmin.php?orderID='.$item['id'].'" style="color:white;text-decoration:none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="lightgreen" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> Ship Order</a></button></div> <b title="Cancel Item"><div class="row mt-1"><button class="btn btn-danger btn-xl"><a href="/blockchainsys/kit/static/includes/cancelOrderAdmin.php?orderid='.$item['id'].'" style="color:white;text-decoration:none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Reject Order</a></button><div></td>
                </tr>';
    }
?>




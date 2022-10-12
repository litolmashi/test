<?php
	ini_set('display_errors', 1);
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$id = $_SESSION['userID'];
	
	$sql = "SELECT * FROM orders WHERE sellerid = '$id' && status = 'COMPLETED'";
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
                    <td>'.$item['receivedDate'].'</td>
                    <td><b title="View Order"><div class="row"><button class="btn btn-info btn-xl"><a href="/blockchainsys/kit/static/includes/viewOrderAdmin.php?productid='.$item['id'].'&orderID='.$item['id'].'" style="color:white;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="lightgreen" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> Track Order</a></button></div></td>
                </tr>';
    }
?>


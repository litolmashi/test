<?php
	ini_set('display_errors', 1);
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$id = $_SESSION['userID'];
	
	$sql = "SELECT * FROM orders WHERE sellerid = '$id' && status = 'CANCELLED'";
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
                    <td>'.$item['cancelDate'].'</td>
                    <td>'.$item['delivery'].'</td>
                    <td>'.$item['status'].'</td>
                </tr>';
    }
?>

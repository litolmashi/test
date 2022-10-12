<?php
	ini_set('display_errors', 1);
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$id = $_SESSION['userID'];
	
	$sql = "SELECT * FROM orders WHERE userid= '$id' && status='COMPLETED'";
	$result = $conn->query($sql);
	foreach ($result as $item){
      echo'
      	<tr>
                    <td>'.$item['id'].'</td>
                    <td>'.$item['productid'].'</td>
                    <td>'.$item['brand'].'</td>
                    <td>'.$item['name'].'</td>
                    <td>'.$item['price'].'</td>
                    <td>'.$item['quantity'].'</td>
                    <td>'.$item['delivery'].'</td>
                    <td>'.$item['payment'].'</td>
                    <td>'.$item['receivedDate'].'</td>
                </tr>';
    }
?>


<!-- <td><div><a href="/blockchainsys/kit/static/includes/viewOrder.php?productid='.$item['id'].'" style="width:80%;" class="eltd-btn eltd-btn-small eltd-btn-solid">
<span class="eltd-btn-text">COMING SOON</span>
<span class="eltd-btn-overlay"></span>
</a></div></td> -->

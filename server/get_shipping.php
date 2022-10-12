<?php
	ini_set('display_errors', 1);
    $path = "/var/www/webroot/blockchainsys/config/db_config.php";
    include_once($path);
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$id = $_SESSION['userID'];
	
	$sql = "SELECT * FROM orders WHERE status='SHIPPED' && userid='$id'";
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
                    <td><div class="col-12 row"><a href="/blockchainsys/kit/static/includes/viewOrderAdmin.php?productid='.$item['id'].'" style="width:80%;" class="eltd-btn eltd-btn-small eltd-btn-solid">
<span class="eltd-btn-text">Track Order</span>
<span class="eltd-btn-overlay"></span>
</a></div><div class="col-12 row"><a href="/blockchainsys/kit/static/includes/receiveOrder.php?orderid='.$item['id'].'" style="width:80%;color: #f0f0f0;background-color: #444444;border-color: #444444" class="eltd-btn eltd-btn-small eltd-btn-solid eltd-btn-custom-hover-bg eltd-btn-custom-border-hover eltd-btn-custom-hover-color" data-hover-bg-color="#f0f0f0" data-hover-color="#333333" data-hover-border-color="#f0f0f0">
<span class="eltd-btn-text">RECEIVE ORDER</span>
<span class="eltd-btn-overlay" style="background-color: rgb(240, 240, 240);"></span>
</a></div></td>
                </tr>';
    }
?>



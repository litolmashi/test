<?php
session_start();
error_reporting();
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost', 
    'user' => 'blockchain', 
    'pass' => 'blockchain', 
    'db'   => 'blockchaindb' 
); 
// $editor->where( 'status', 'CART' );
// DB table to use 
$table = 'orders';
$id = $_SESSION['userID'];
 
// Table's primary key 
$primaryKey = 'id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    // array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'id',     'dt' => 0 ), 
    array( 'db' => 'productid',    'dt' => 1 ),
    array( 'db' => 'quantity',    'dt' => 2 ),
    array( 'db' => 'fullname',    'dt' => 3 ),
    array( 'db' => 'price',    'dt' => 4 ),
    array( 'db' => 'orderdate',    'dt' => 5 ),
    array( 'db' => 'delivery',    'dt' => 6 ),
    array( 'db' => 'status',    'dt' => 7 ),
); 
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    SSP::complex( $_GET, $dbDetails, $table, $primaryKey, $columns, null, "sellerid = '$id' && status='WAITING FOR CONFIRMATION'") 
);
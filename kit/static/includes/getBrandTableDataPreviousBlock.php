<?php 
error_reporting();
session_start();
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost', 
    'user' => 'blockchain', 
    'pass' => 'blockchain', 
    'db'   => 'blockchaindb' 
); 
 
// DB table to use 
$table = 'brandsbc';
$name = $_SESSION['name'];
 
// Table's primary key 
$primaryKey = 'id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'brandid', 'dt' => 0 ),
    array( 'db' => 'brand',     'dt' => 1 ), 
    array( 'db' => 'description',    'dt' => 2 ),
    array( 'db' => 'datecreated',    'dt' => 3 ),
    array( 'db' => 'previousowner',    'dt' => 4 ),
    array( 'db' => 'currentowner',    'dt' => 5 ),
    array( 'db' => 'datetransferred',    'dt' => 6 ),
); 
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    SSP::complex( $_GET, $dbDetails, $table, $primaryKey, $columns, null, "previousowner = '$name' && currentowner <> '$name'") 
);
?>
<?php 
error_reporting();
ini_set('display_errors', 1);
// Database connection info 
$dbDetails = array( 
    'host' => 'node103045-eblockchainsys.w1-us.cloudjiffy.net', 
    'user' => 'root', 
    'pass' => 'OOIrez31164', 
    'db'   => 'blockchaindb' 
); 
//$newpath = "/var/www/webroot/blockchainsys/config/db_config.php";
//include_once($newpath);
//$newConn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
//$dbDetails = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 
// DB table to use 
$table = 'productsbc'; 
 
// Table's primary key 
$primaryKey = 'id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'productid', 'dt' => 0 ),
    array( 'db' => 'brand',     'dt' => 1 ), 
    array( 'db' => 'name',    'dt' => 2 ),
    array( 'db' => 'price',    'dt' => 3 ),
    array( 'db' => 'quantity',    'dt' => 4 ),
    array( 'db' => 'dateadded',    'dt' => 5 ),
); 
 
// Include SQL query processing class 
require 'ssp.class.php';
 
// Output data as json format 
echo json_encode( 
    SSP::complex( $_GET, $dbDetails, $table, $primaryKey, $columns, null, "status = 'active'") 
);


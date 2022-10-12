<?php
        //$path = $_SERVER['DOCUMENT_ROOT'];
        $path = "/var/www/webroot//blockchainsys/config/";

        require_once($path.'vendor/autoload.php');

        //$dotenv = Dotenv\Dotenv::createImmutable($path);
        //$dotenv->load();

        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
        $collection = $client->adminDB->userCredentials;

        $query=array();
        $getUserNames=$collection->find(array("user_role" => array ('$ne' => '1')));

        foreach ($getUserNames as $doc) {
            echo "<option>".$doc['user_firstname']." ".$doc['user_middlename']." ".$doc['user_lastname']."</option>";
        }
?>

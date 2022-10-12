<?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/blockchainsys/config/";

        require_once "/var/www/webroot/blockchainsys/config/vendor/autoload.php";

        //$dotenv = Dotenv\Dotenv::createImmutable($path);
        //$dotenv->load();

        $client = new MongoDB\Client(
        	'mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
        $collection = $client->adminDB->brandInformationServer;

        $query=array();
        $getBrandNames=$collection->find(['currentOwner' => $_SESSION['name']],$query);

        foreach ($getBrandNames as $doc) {
            echo "<option>".$doc['brandName']."</option>";
        }
?>



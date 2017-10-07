<?php 

ini_set('memory_limit', '1024M');

$shipments = json_decode(file_get_contents("products.json"), true);
print_r($shipments);

?>

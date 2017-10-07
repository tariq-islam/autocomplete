<?php 

// TODO: Reduce this down to 256 MB
ini_set('memory_limit', '1024M');

$shipments = json_decode(file_get_contents("products.json"), true);
print_r($shipments);

// alternatively...
//
// $shipments = json_encode(json_decode(file_get_contents("shipments.js"), true));
// echo $shipments;
?>

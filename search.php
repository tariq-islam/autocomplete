<?php

// TODO: Reduce this down to 256 MB
ini_set('memory_limit', '1024M');

sleep( 2 );
// no term passed - just exit early with no response
if (empty($_GET['term'])) exit ;
$q = strtolower($_GET["term"]);
// remove slashes if they were magically added
if (get_magic_quotes_gpc()) $q = stripslashes($q);

// TODO: Build this array of $items from the output of the conversion from the json file (basically read in the string of associative arrays post-conversion)
$items = json_decode(file_get_contents("products.json"), true);

$result = array();
$zero = 0;
foreach ($items as $key=>$value) {
	if (strpos(strtolower($value["name"]), $q) !== false) {
		array_push($result, array("id"=>$value["category"][$zero]["name"], "label"=>$value["name"], "value" => strip_tags($value["name"])));
	}
	if (count($result) > 11)
		break;
}

// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
$output = json_encode($result);

if ($_GET["callback"]) {
	// Escape special characters to avoid XSS attacks via direct loads of this
	// page with a callback that contains HTML. This is a lot easier than validating
	// the callback name.
	$output = htmlspecialchars($_GET["callback"]) . "($output);";
}

echo $output;

?>

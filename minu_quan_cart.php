<?php 
session_start();
$product_id = $_GET['product_id'];

foreach ($_SESSION['cart'] as $key => &$value) {
	if($value > 0){
		if($key == $product_id){
		$value--;
		}
	}
}

echo json_encode($_SESSION);
?>
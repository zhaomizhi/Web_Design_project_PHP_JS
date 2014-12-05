<?php 

session_start();

$pro_id = $_POST['product_id'];

if(isset($_SESSION['cart'][$pro_id])){
	$_SESSION['cart'][$pro_id]++;
}else{
	$_SESSION['cart'][$pro_id] = 1;
}


echo json_encode($_SESSION);
?>


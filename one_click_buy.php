<?php
session_start();


include("connect_database.php"); 
$product_id = $_POST['product_id'];
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id '];

$sql_price = "SELECT cost from product where product_id = '$product_id'";
$result = mysqli_query($connection, $sql_price);
if($db_found){
	if(mysqli_num_rows($result) > 0){
		if ($db_field = mysqli_fetch_assoc($result)) {
			$cost = $db_field['cost'];
		}
	}
}
$date = date('Y-m-d');
$sql_withuserid = " INSERT INTO order_detail(product_id, quantity, user_id, price,issued_date) VALUES ('$product_id','1','$user_id','$cost','$date')";
$return = $_POST;

if($db_found){
	if(isset($user_id)){

		$result = mysqli_query($connection,$sql_withuserid);
		if($result){
			$return['insert'] = "success";
		}else{
			$return['insert'] = "failed";
		}
		$return['query'] = 'query yes';
	}else{
		$return['query'] = 'query no';
	}
	$return['result_found'] = 'found yes';
}else{
	$return['result_found'] = 'not';
}

echo json_encode($return);
mysqli_close($connection);

?>

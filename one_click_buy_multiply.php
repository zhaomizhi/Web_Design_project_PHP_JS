<?php
session_start();


include("connect_database.php"); 

$shopping_items = $_SESSION['cart'];
$user_id = $_SESSION['user_id '];
$date = date('Y-m-d');
foreach ($shopping_items as $key => $value) {
	$sql_price = "SELECT cost from product where product_id ='$key'";
	$result = mysqli_query($connection, $sql_price);
	$cost = 0;
	if(mysqli_num_rows($result) > 0){
		if ($db_field = mysqli_fetch_assoc($result)) {
			$cost = $db_field['cost'];
		}
	}

	$sql_insertitem = "INSERT INTO order_detail
	(product_id,quantity,user_id,price,issued_date)
	 VALUES ('$key', '$value','$user_id','$cost','$date')"; 
	$result = mysqli_query($connection,$sql_insertitem);
	if($result){
		$return['insert'] = "success";
	}else{
		$return['insert'] = "failed";
	}

	$flag = true;
	for ($i=0; $i < count($return['insert']); $i++) { 
		if($return['insert'] == 'success'){
			$flag = true;
		}else if ($return['insert'] == 'failed'){
			$flag = false;
			break;
		}
	}

	if($flag){
		unset($_SESSION['cart']);
	}
}
	echo json_encode($_SESSION);
	mysqli_close($connection);


?>

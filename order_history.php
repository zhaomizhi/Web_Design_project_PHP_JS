<?php 

$user_id = $_SESSION['user_id '];
if($db_found){
	$sql = "select product_id, quantity, price, user_id , issued_date from order_detail where user_id ='$user_id'";
	$result = mysqli_query($connection, $sql);
	if(mysqli_num_rows($result) > 0){
	$order_list = array();
	$order_list['result'] ="records";
		while ($db_field = mysqli_fetch_assoc($result)) {
			$order_list['order'][] = array(
				'product_id' => $db_field['product_id'],
				'quantity' => $db_field['quantity'],
				'price' => $db_field['price'],
				'user_id' => $db_field['user_id'],
				'date' =>$db_field['issued_date']
				);
		}
	}else{
		$order_list['result'] ="no record";
	}
}	

?>
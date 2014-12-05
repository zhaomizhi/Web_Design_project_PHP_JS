<?php 

		
			$product_in_cart = array();
			foreach ($_SESSION['cart'] as $key => $value) {
				$sql = "select name, cost, image_address from product where product_id='$key'";
				$result = mysqli_query($connection, $sql);
				if(mysqli_num_rows($result)>0){
					if($db_field = mysqli_fetch_assoc($result)){
						$product_in_cart['product'][] = array(
							'song_name' => $db_field['name'],
							'counts' => $value,
							'product_id' => $key,
							'cost' =>$db_field['cost'],
							'image_address' => $db_field['image_address']
							);
					}
					
				}
			}

?>
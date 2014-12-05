<?php 
include("connect_database.php"); 

$singer_name = $_REQUEST['singer_name'];


if($db_found){
	$getuserInfoSql = "select singer_id, singer_name, description, singer_img_address from singers where singer_name Like '$singer_name%'";
	$result = mysqli_query($connection, $getuserInfoSql);
	if(mysqli_num_rows($result) >0){
		$return = array();
		$return['result'] = 'success';
		while($db_field = mysqli_fetch_assoc($result)){
			$return['singer'][] = array(
				'singer_id' => $db_field['singer_id'],
				'singer_name' => $db_field['singer_name'],
				'description' => $db_field['description'],
				'singer_img_address' => $db_field['singer_img_address']);
		 }echo json_encode($return);
		// }print_r($return) ;
		
	}else{
		$return['result'] = 'not record';
		$return['singer_id'] = '';
		$return['singer_name'] = '';
		$return['description'] = '';
		$return['singer_img_address'] = '';
		echo json_encode($return);
	}
}


mysqli_close($connection);



?>
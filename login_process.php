<?php 
session_start();
$connection = mysqli_connect("localhost","root","root");
if($connection -> connect_error){
	die("connection failed: " . $connection->connect_error );
}else{
}
$db_found = mysqli_select_db($connection, "web_design_database");


$email_form = $_POST['email'];
$password_form = $_POST['password'];



if($db_found){
	$getuserInfoSql = "select user_id, email, password, username from user where email = '$email_form'";
	$result = mysqli_query($connection, $getuserInfoSql);
	if(mysqli_num_rows($result) >0){
		$db_field = mysqli_fetch_assoc($result);
		$email  = $db_field['email'];
		$password = $db_field['password'];
		$username = $db_field['username'];
		$user_id = $db_field['user_id'];
		
	}else{
		echo "result is null";
	}
}




$return = $_POST;
if($password_form  == $password){
	$return['matchCheck'] = "Match";
	$return['username'] = $username;
	$_SESSION['username'] = $username;
	$_SESSION['user_id '] = $user_id;
}else{
	$return['matchCheck'] =  "NotMatch";
}

echo json_encode($return);

mysqli_close($connection);




?>
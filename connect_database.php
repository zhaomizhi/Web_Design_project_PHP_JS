
<?php 
$connection = mysqli_connect("localhost","root","root");
if($connection -> connect_error){
	die("connection failed: " . $connection->connect_error );
}else{
}
$db_found = mysqli_select_db($connection, "web_design_database");

?>
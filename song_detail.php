<?php session_start()?>
<!DOCTYPE HTML>
<html>
	<head>	

	
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  	<meta content="utf-8" http-equiv="encoding">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/support.css">
	<link rel="stylesheet" type="text/css" href="assets/css/support_destop.css">

	<script type="text/javascript" src = "assets/js/jquery.min.js"></script>
	<script type="text/javascript" src = "assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src = "assets/js/bootbox.min.js"></script>




	</head>

	
	
	

	<body >

		<!-- header -->
		<div id = "header-wrapper-support">  			
  				<div class = "header-col-2 floatleft">
  					<img id = "logo" src="images/wangyilogo.png">
  				</div>
  				<div class = "header-col-4 floatleft">
  					<ul>
  						<li><a href="index.php">Homepage</a></li>
  						<li><a href="shopping_cart.php">My Music</a></li>
  						<li><a href="">Friends</a></li>

  					</ul>

  				</div>
  				<div class = "header-col-2 floatleft">
  					<input placeholder = "search" id = "search" type = "search">
  				</div>
  				<div class = "header-col-2 floatleft">
  					<div class="dropdown">
  						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
    						Shopping Cart
    					<span class="caret"></span>
 						</button>
 						<ul class="dropdown-menu sc_dropdown" role="menu" aria-labelledby="dropdownMenu1">
					
						<?php 
	
						if(isset($_SESSION['cart'])){
						include("connect_database.php"); 
						include("sc_products_list.php");
						
						$total = 0;
						for ($i=0; $i < count($product_in_cart['product']); $i++) { ?>
							<li role = "presentati on" class = "li_down_list">
								<a class = "links_down_list floatleft" href="song_detail.php?id=<?php echo $product_in_cart['product'][$i]['product_id'];?>"><?php echo $product_in_cart['product'][$i]['song_name']; ?></a>
								<span class = "counts_down_list floatleft">Quantity:<?php echo $product_in_cart['product'][$i]['counts'];?></span>
								<img class = "redline_list" src="images/line_list.png">
								<?php $total = $total+ $product_in_cart['product'][$i]['counts']*$product_in_cart['product'][$i]['cost']; ?>
							</li>
						<?php }	?>
						<li role = "presentati on" class = "li_down_list" id = "total_list">Total: <?php echo $total;?></li>
						<li role = "presentation"><a href="shopping_cart.php">Edit or Check Out</a></li>
				
				<!-- if there is nothing in shopping cart -->
					<?php } else { echo "<span class = 'empty_cart_span'>Your cart is empty. <span>"; }?>
					</ul>
				</div>
  			</div>
  			<div class = "clear"></div>
  		<!-- End of header -->
		</div>
		<div class = "content">
			<div class = "welcome_title">
				<p id = "wlc_header">Welcome, <?php 
					if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
						echo  $_SESSION['username'];
					}else{
						echo "Guest";
					}
				?></p>
			</div>

			

		
			<div class = "song_detail">
				<?php 
				include("connect_database.php"); 
				$id = $_GET['id'];
				if($db_found){
					$sql = "select image_address, description, singer_id,lyr,name from product where product_id = '$id'";
					$result = mysqli_query($connection, $sql);
					if(mysqli_num_rows($result) > 0){
						$return = array();
						while($db_field = mysqli_fetch_assoc($result)){
							$image_address = $db_field['image_address'];
							$song_name = $db_field['name'];
							$des = $db_field['description'];	
							$lyr = $db_field['lyr'];
							$singer_id = $db_field['singer_id'];
						}
					}
					
					$sql2 = "select singer_name from singers where singer_id ='$singer_id'";
					$result2 = mysqli_query($connection, $sql2);
					$db_field2=  mysqli_fetch_assoc($result2);
					$singer_name = $db_field2['singer_name'];
					
				}
			
				?>

				<div class = "img_div floatleft">
					<img src="<?php echo $image_address; ?>" >
					<img src="images/diezi.png" class = "mask_img">
				</div>
				<div class = "ly_div floatleft">
					<img  class = "floatleft" src="images/arrow.png" id = "arrow">
					<h4 class = "floatleft"><?php echo $song_name;?></h4>
					<div class = "clear"></div>
					<h5><a href="singer_detail.php?singer_name=<?php echo $singer_name;?>"> <?php echo $singer_name;?></a> </h5>
					<?PHP if(isset($_SESSION['username']) && !empty($_SESSION['username'])){?>
					<form action = "#" method = "post" id = "addForm" >
						<input  type = "hidden"   name = "product_id" value="<?php echo $id ?>" id = "hidden_product_id"/>
        				<input type="submit" id = "addToChart" class = "floatleft  addToChart_play btn btn-primary"  value = "Add to Cart" /> 
        				<input type="submit" id = "one_click_buy" class = "floatleft  addToChart_play btn btn-primary"  value = "Buy Immediately" /> 
        				<button class = "addToChart_play btn btn-primary floatleft"> Play!</button>       				
   					</form><?php }else{ ?>
   					<form action = "#" method = "post" id = "addForm2" >
						<input  type = "hidden"   name = "product_id" value="<?php echo $id ?>" id = "hidden_product_id"/>

        				<button  id = "addToChart_ses_button" class = "  addToChart_play btn btn-primary"  >Add to cart</button>
        				<button class = "addToChart_play btn btn-primary "> Play!</button>       				
   					</form>
   					<?php } ?>
   					
   					<div class = "clear">

   					<div class = "ly_content"><?php echo $lyr;?></div>
   					<div class = "descrption"><?php echo $des;?></div>
				</div>
				<div class = "clear"></div>
			</div>
		</div>
	</div>
		<div class = "footer"> 
			<ul>
				<li><a href="#">About</a></li> 
				<li><a href="#">Job</a></li>
				<li><a href="#">Press</a></li>
				<li><a href="#">Blog</a></li>
				<li><a href="#">Gift</a></li>
			</ul>
		</div>



		
		<script type="text/javascript" src = "assets/js/support.js">
		</script>

		<script type="text/javascript">
		var pro_id = $("#hidden_product_id").val();
		$("#one_click_buy").click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$.ajax({ url: 'one_click_buy.php', 
					dataType:'json',
					type: 'post', 
					data:  { product_id: pro_id} , 
					
					success: function( data, textStatus, jQxhr ){ 
						bootbox.alert("Buy Successful");					 
					 }, 
					error: function( jqXhr, textStatus, errorThrown ){ 
						console.log(errorThrown);
					} 
				});
			});

		
		$("#addToChart").click(function(event) {
			event.preventDefault();
			$.ajax({ url: 'addToChart_session.php', 
					dataType:'json',
					type: 'post', 
					data:  { product_id: pro_id} , 
					
					success: function( data, textStatus, jQxhr ){ 
						bootbox.alert("Add Successful");	
						console.log(data);				 
					 }, 
					error: function( jqXhr, textStatus, errorThrown ){ 
						console.log(errorThrown);
					} 
				});
		});

		$("#addToChart_ses_button").click(function(event) {
			event.preventDefault();
			$.ajax({
				url: "addToChart_session.php",
				dataType:'json',
				data:  { product_id: pro_id},
				type: 'post', 
				success: function(data){
					console.log(data);
					bootbox.dialog({
						message: "Add successful",
						
						buttons: {
							success: {
								label: "Keep shopping",
								className: "btn-primary",
								callback: function() {
									
								}
							},
							main: {
								label: "Log in",
								className: "btn-primary",
								callback: function() {

								}
							}
						}
					});
				}, error: function(jqXhr, textStatus, errorThrown ){
					console.log(errorThrown);
				}
			});
		});
			
		</script>

	</body>
</html>

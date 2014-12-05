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


	<body>

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
 					<!-- if there is something in shopping cart -->

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
          <?php } ?>
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

        <?php $singer_name = $_GET['singer_name'];
          include("connect_database.php"); 
          $sql = "select description, singer_id,singer_img_address from singers where singer_name ='$singer_name'";
          $result = mysqli_query($connection, $sql);
          if(mysqli_num_rows($result) > 0){
            $db_field = mysqli_fetch_assoc($result);
            $description = $db_field['description'];
            $address = $db_field['singer_img_address'];
            $singer_id = $db_field['singer_id'];
          }


          $keep_size = strlen($address)-5;
          $address = substr($address, 0,$keep_size);
          $address .="640y300";


          $sql2 = "select product_id, name from product where singer_id='$singer_id'";
          $result2 = mysqli_query($connection, $sql2);
          $return = array();
          if(mysqli_num_rows($result2) > 0){
            while($db_field2 = mysqli_fetch_assoc($result2)){
               $return['song'][]  = array(
                'song_id' => $db_field2['product_id'], 
                'song_name'=> $db_field2['name']);

            };           
          }


        ?>

        <div class = "wrap_img">
           <div class = "img_des shadow4 fadein">
            <img  id = "img_it" src="<?php echo $address?>" >
        </div>
        </div>
       
      
        <h4 id = "name_in_image"><a href=""> <?php echo $singer_name;?></a></h4>


        
        <div class = "song_table">
          <ul class="nav nav-tabs">
            <li><a href="#home" data-toggle="tab">Home</a>
            </li>
            <li><a href="#profile" data-toggle="tab">Profile</a></li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="home">
              <table class="table table-striped">
               
                  <?php 
                
                    foreach ($return as $key ) {
                      for ($i=0; $i <count($key) ; $i++) {
                          $name = $key[$i]['song_name'];
                          $id = $key[$i]['song_id'];
                          echo " <tr><td> <a href='song_detail.php?id=$id'>$name</a></td></tr>";
                      }
                    }
                  ?>
                
                
              </table>
            
            </div>
            <div class="tab-pane" id="profile">
              <p><?php echo $description;?></p>
            </div>
 
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

<!--     <div class="img shadow4 fadein">
<img class="rd" src="http://chiasmrhythm.files.wordpress.com/2014/03/sao1-3c_768x432.png">
</div> -->
   
    <script type="text/javascript">




    </script>
  </body>
</html>

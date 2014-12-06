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
              <a class = "links_down_list floatleft" href="song_detail.php?id=<?php echo $product_in_cart['product'][$i]['product_id'];?>">
                <?php echo $product_in_cart['product'][$i]['song_name']; ?></a>
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
    <div class = "content sc_content">
 
      <div class = "cart_content floatleft">
        <h3>Shopping Cart</h3>
       <!--  shopping cart is not empty -->
        <?php 
      
        if(isset($_SESSION['cart']) ){ 
          include("connect_database.php"); 
          include("sc_products_list.php");
          $empty = array();
      
          ?>
        <ul class = "cart_page_list">
          <?php 
    

          for ($i=0; $i <count($product_in_cart['product']) ; $i++) { 
                 if($product_in_cart['product'][$i]['counts'] > 0){
                  
          ?>
            <li >
            <div class = "image-wrap floatleft" >
              <img src="<?php echo $product_in_cart['product'][$i]['image_address'] ?>">   
            </div>
            <div class = "order_item_detail floatleft">
              <p><a href="song_detail.php?id=<?php echo $product_in_cart['product'][$i]['product_id'];?>"><?php echo $product_in_cart['product'][$i]['song_name'];?></a></p>
              <p> Price($):<span class = "price"> <?php echo $product_in_cart['product'][$i]['cost'];?> </span>
              <span width= "30px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
              Quantity: <span class = "quantity"><?php echo $product_in_cart['product'][$i]['counts'];?> </span>
              <form>
                  <input value = "<?php echo $product_in_cart['product'][$i]['product_id'];?>"  name = "product_id" type  = "hidden" id = "hidden_field">
                  <button class = "up_quan_button" ><span class = "glyphicon glyphicon-chevron-up"></span></button>
                  <button class = "down_quan_button"><span class = "glyphicon glyphicon-chevron-down"></span></button>
              </form>
              </p>
              <p>Amount($): <span class = "one_item_amount"> <?php echo $product_in_cart['product'][$i]['cost']*$product_in_cart['product'][$i]['counts'];?></span></p>
              
            </div>
            <div class = "clear"></div>
          </li>
         <?php  
        }
       } ?>

        </ul>
        <div class = "bottom_total">The total amount is : <span id = "total_amount">&nbsp; </span></br>
          <button id = "check_out" class = "btn btn-default">Check out</button>
        </div>


        <?php }?>
        <div class = "empty_cart">
          <p>You have no items in your Shopping Bag</p>
          <p><a href="index.php">Continue Shopping</a></p>
        </div>
      </div>
      <div class = "log_ord_his floatleft">
        <?php if(isset($_SESSION['username']) && !empty($_SESSION['username'])){?>
        <?php include("connect_database.php"); 
              include("order_history.php");
              if($order_list['result'] == 'no record'){
                echo "<p id = 'result_order'>There is not order history.</p>";
              }else{ ?>
              <div class = "order_history_content">
              <h4>Order History</h4>
           
                <ul>
              <?php  for($i = 0; $i < count($order_list['order']); $i++){ ?>
                  <li>
                    <?php $product_id = $order_list['order'][$i]['product_id'];
                      $sql = "select name from product where product_id ='$product_id'";
                      $result = mysqli_query($connection, $sql);
                      if(mysqli_num_rows($result) > 0){
                        if($db_field = mysqli_fetch_assoc($result)){
                            $product_name = $db_field['name'];
                        }
                      } ?>
                      <a href=""><?php echo $product_name;?></a> 
                      Quantity:<span><?php echo $order_list['order'][$i]["quantity"];?></span> 
                      Total($) : <?php echo $order_list['order'][$i]["quantity"]*$order_list['order'][$i]["price"];?></br>
                      <p id = "is_date">Issued Date: <?php echo $order_list['order'][$i]["date"];?></p>

                  </li>
               <?php } ?>
                </ul>
              </div>

           <?php   } ?>


          <div class = "order_history">

          </div>
        <?php } else { ?>

          <span id = "loginhint" ></span> 
          <form class = "login-form-cart" method = "post" action = "login_process.php" >
             <div class="form-group">
               <input name = "email" type = "email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" >
             </div>
             <div class="form-group">
               <input name = "password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
             </div>              
             <input type="submit"  value= "submit" class="btn btn-default "   id = "loginbuttontwo_cart"> </input>
                       
            </form>
        <?php }?>

      </div>
      <div class = "clear"></div>

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
<p></p>



    <script type="text/javascript">
    $(document).ready(function() {

      calculate_amout();
      show_empty_link();
      showTotal();

      // function showTotal(){
      //    console.log($(".cart_content ul"));
      //     if($(".order_history_content ul").children().length > 0){
      //       $(".bottom_total").css('display', 'none');
      //       console.log("ss");
      //   }
      // }
      function showTotal(){
        console.log($(".cart_page_list").has("li").length);

         if($(".cart_page_list").has("li").length == 0){
           $(".bottom_total").css('display', 'none');
           // console.log("none");
         }
      }

      $("#check_out").click(function(event) {
        event.preventDefault();
        bootbox.confirm("Processed to check out", function(result){
          if(result){
            $.ajax({
              url: 'one_click_buy_multiply.php',
              type: 'GET',
              dataType: 'json',
              data: {param1: 'value1'},
            })
            .done(function() {

              location.reload();
            })
            .fail(function() {
              console.log("error");
            })
            .always(function() {
              console.log("complete");
            });
          }       
       })
      });
      
      $(".up_quan_button").click(function(event) {
        event.preventDefault();
        var product_id = this.parentElement[0].value;
        var price = $(this).closest('div').find('.price')[0].innerHTML;
        var quantity_with_id = $(this).closest('div').find('.quantity')[0];
        var quantity = parseInt(quantity_with_id.innerHTML) +1;
        var one_item_amount = $(this).closest('div').find('.one_item_amount')[0];
        
        $.get('add_quan_cart.php',{product_id: product_id},function(data) {
          quantity_with_id.innerHTML =  quantity; 
          one_item_amount.innerHTML = parseInt(one_item_amount.innerHTML) + parseInt(price);
          calculate_amout();

        },"json").fail(function(jqXhr, textStatus, errorThrown ) {
          console.log( errorThrown);
        });
      });

       $(".down_quan_button").click(function(event) {
            event.preventDefault();
            var item_list = $(this).closest('li');
            var product_id = this.parentElement[0].value;
            var price = $(this).closest('div').find('.price')[0].innerHTML;
            var quantity_with_id = $(this).closest('div').find('.quantity')[0];
            var quantity = parseInt(quantity_with_id.innerHTML) -1;
            var one_item_amount = $(this).closest('div').find('.one_item_amount')[0];




            if(quantity + 1 > 1 ){
              $.get('minu_quan_cart.php',{product_id: product_id},function(data) {
                 quantity_with_id.innerHTML =  quantity; 
                 one_item_amount.innerHTML = parseInt(one_item_amount.innerHTML)-parseInt(price);
                 calculate_amout();
                 show_empty_link();
                 showTotal();
               },"json").fail(function(jqXhr, textStatus, errorThrown){
                    console.log( errorThrown);
              });
            } else if (quantity + 1 == 1){
                bootbox.confirm("Do you want to remove this item?", function(result) {
                if(result == 1){
                item_list.remove();
                $.get('minu_quan_cart.php',{product_id: product_id},function(data) {
                 // quantity_with_id.innerHTML =  quantity; 
                 // one_item_amount.innerHTML = parseInt(one_item_amount.innerHTML)-parseInt(price);
                
                },"json").fail(function(jqXhr, textStatus, errorThrown){
                    console.log( errorThrown);
                });
                 calculate_amout();
                 show_empty_link();
                 showTotal();
                }
              });
            }
       });


      $("#loginbuttontwo_cart").click(function(event) {
          event.preventDefault();

          var formEmail = $('#exampleInputEmail1').val();
          var password = $('exampleInputPassword1').val();
          if(formEmail == '' || password == ''){
          $("#loginhint").html("Please fill the form")
            }
          $.ajax({ url: 'login_process.php', 
          dataType:'json',
          type: 'post', 
          data:  { email: $('#exampleInputEmail1').val(), 
              password: $('#exampleInputPassword1').val() } , 
          
          success: function( data, textStatus, jQxhr ){ 
            console.log(data);
            if(data['matchCheck'] =='NotMatch'){
              $("#loginhint").html('Failed, try again.');
            }else{
              location.reload();
              
            }
             
           }, 
          error: function( jqXhr, textStatus, errorThrown ){ 
            $("#loginhint").html('Please try again.');
          } 
      });

      });



      function calculate_amout(){

        var amount = $(".one_item_amount");
        var total_amount = 0;
        for(var i = 0; i<amount.length;i++){
          total_amount = parseInt(amount[i].innerHTML) + parseInt(total_amount);
        }
        $("#total_amount").html(total_amount);
      } 

      function show_empty_link(){
        var quantity = $(".quantity");
        var total_quantity = 0;
        for(var i = 0; i<quantity.length;i++){
          total_quantity = parseInt(quantity[i].innerHTML) + parseInt(total_quantity);
        }

        if(total_quantity > 0){
          $(".empty_cart").css('display', 'none');
          // console.log("block");
        }else{
           $(".empty_cart").css('display', 'block');
           // console.log("none");
        }
      }


    });
    </script>
  </body>
</html>
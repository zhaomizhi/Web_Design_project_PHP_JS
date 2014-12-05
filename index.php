<?php session_start();?>

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

</head>




<div>
	<body >
	</div>

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


	<!-- banner -->
	<div id = "banner-support">
		<div id = "bannerleft" class = "floatleft bannerhanddler">
			<a href="" id = "abannerleft"><img src="images/banner/Slice1.png"></a>
		</div>
		<img src="images/demo1/1.jpg" class = "floatleft" name = "banner" id = "bannerimage">
		<div id = "bannerright" class = "floatleft bannerhanddler"><a href="" id = "abannerright"><img src="images/banner/Slice2.png"></a></div>
		<div class ="clear"></div>
	</div>
	<div class = "content"> 
		<div class = "content-tables floatleft" >
			<div class = "content-table recommend"> 
				<div class = "table_header">
					<a href="" class = "table_header_first floatleft"> Recommendations</a>
					<div class = "header_tabs floatleft">
						<a href="">Pop</a>
						<span>|</span>
						<a href="">Rock</a>
						<span>|</span>
						<a href="">Jazz</a>
						<span>|</span>
						<a href="">Indie</a>
						<span>|</span>

					</div>
					<div class = "clear"></div>
				</div>
				<div class = "table-list-cover">
					<ul class ="first-tables">
						<li><img src="http://p3.music.126.net/dDwXNp9CZl1YWHTQs1XLTA==/835628837133532.jpg?param=140y140">
							<a class = "table-image-text" href="song_detail.php?id=1">My All</a>
						</li>
						<li><img src="http://p3.music.126.net/eU74eRXIMXpqhjugwm13aA==/2534374303677717.jpg?param=140y140">
							<a class = "table-image-text" href="">Old Fashin</a>
						</li>

						<li><img src="http://p3.music.126.net/fxHIMPDqktx4QyguOf89Mw==/3228166139780374.jpg?param=140y140">
							<a class = "table-image-text" href="">Old Fashin</a></li>
							<li><img src="http://p3.music.126.net/J5NoOCdOG9F8ZS3xDSN04Q==/3242459790973119.jpg?param=140y140">
								<a class = "table-image-text" href="">Old Fashin</a></li>
							</ul>
							<ul class = "second-tables">
								<li><img src="http://p3.music.126.net/cSaeLbFx55qGh8o61vuL7A==/3222668581743763.jpg?param=140y140">
									<a class = "table-image-text" href="">Old Fashin</a>
								</li>
								<li><img src="http://p4.music.126.net/IbYA-b9_tHEzZQyW6mXTSg==/3223768093427607.jpg?param=140y140">
									<a class = "table-image-text" href="">Old Fashin</a>
								</li>

								<li><img src="http://p4.music.126.net/kEeBWVJmq1RJp74R5EB4Rg==/3222668581638511.jpg?param=140y140">
									<a class = "table-image-text" href="">Old Fashin</a></li>
									<li><img src="http://p4.music.126.net/LjK7BvNOOfXXK9ydKmtR-A==/3228166139831150.jpg?param=140y140">
										<a class = "table-image-text" href="">Old Fashin</a></li>
									</ul>
								</div>
							</div>
							<div class = "content-table top-songs"> 
								<div class = "table_header"><a class = "table_header_first" href="">Top 5</a>
								</div>
								<div id = "dl-body-topsong">
									<dl class = "floatleft">
										<div class = "dl-header">
											<img src="http://p4.music.126.net/c2ADyyL-bQjUPimhTUD-Nw==/6047313953046304.jpg?param=76y76">
											<a href="">Top 5</a>
										</div>

									</dl>


									<dl class = "floatleft">
										<div class = "dl-header">
											<img src="http://p4.music.126.net/hzwSccwihF1s3o9TqiHTjA==/5901078906483408.jpg?param=76y76">
											<a href="">Latest 5</a>
										</div>

									</dl>
									<dl class = "floatleft">
										<div class = "dl-header">
											<img src="http://p3.music.126.net/X5zDEiCGcJw5drUKH1mCvQ==/5972547162256487.jpg?param=76y76">
											<a href="">Original 5</a>
										</div>
									</dl>
									<div class = "clear"></div>

								</div>
							</div>

						</div>
						<div class = "content-singerlists floatleft">	
							<div class = "right-login-area">
								<?PHP if(isset($_SESSION['username']) ){

									?>

									<div class="the-return">
										<P>Welcome back, <?php echo $_SESSION['username'];?></P>
										<a class = "logoutlink" href="logout.php" id = "test">Logout</a>
									</div> 	

									<?PHP
								}else{  

									?>

									
									<p id = "logintext" class = "beforelogin">More fun after you join us</p>
									<button id = "loginbuttone" type="button" class="btn btn-primary beforelogin">Log in</button>
									<form class = "login-form "  method = "post" action = "login_process.php">
										<div class="form-group">

											<input name = "email" type = "email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" >
										</div>
										<div class="form-group">
											<input name = "password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
										</div>  						
										<input type="submit" name = "submit" value= "submit" class="btn btn-default "   id = "loginbuttontwo"> </input>
										<span id = "loginhint"></span>		
									</form>
									<div class = "the-return"></div>

									<?php }						?>




								</div>	

								<div class = "right-search-area">
									<p> <input type = "search" id = "singer_name" placeholder = "Search Singer"></p>

									<span id = "singe_hint" >No record showed in database.</span>
									<ul id = "ul_singers">
									</ul>
								</div>
								<div class = "right-recommend-voice">
									<h4><a href="http://www.nbc.com/the-voice">Channel - The Voice</a> </h4>
									<p>Mondays and Tuesdays 8/7c on NBC. The Voice, the strongest singers in America compete with help from coaches Adam Levine, Blake Shelton, Gwen Stefan</p>
									<img id = "right-voice" src="http://khq.images.worldnow.com/images/16670324_BG2.jpg">
								</div>

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

						<script type="text/javascript" src = "assets/js/support.js"></script>
						<script type="text/javascript">




						$("#singer_name").keyup(function(event) {

							var str  = $("#singer_name").val();
							if(str.length == 0){
								$(".ul_singers_li").remove();
								$("#singe_hint").css('display', 'none');
							}else{
								$.get('search_singer.php?singer_name='+str, function(data) {
									var content = $.parseJSON(data);
									if(content.singer_name === ''){
										$(".ul_singers_li").remove();
										$("#singe_hint").css('display', 'block');

									}else{
										console.log(data);
										$("#singe_hint").css('display', 'none');
										$("#ul_singers").css('display', 'block');
										var length;
										if(i<content.singer.length >4){
											length = 3;
										}else{
											length =content.singer.length;
										}
										for(var i = 0; i<length;i++){
											$("#ul_singers").append("<li class = 'ul_singers_li'> "+ 
												"<img class = 'ul_singer_img' src="+content.singer[i].singer_img_address+">"+
												" <a href=singer_detail.php?singer_name=" + encodeURI(content.singer[i].singer_name) +">" + content.singer[i].singer_name+
												"</a>" +" </li>");	

										}
										(function(){ 
									// $(".ul_singers_li").css('listStyleType', 'none');
									$(".ul_singers_li").css({
										listStyleType: 'none',
										margin: '20px'
									});
									$(".ul_singer_img").css({
										border: '1px solid  #6D453A',
										property2: 'value2'
									});
									$("#ul_singers").css({
										'padding-left': '0px',
										property2: 'value2'
									});

								})();
							}
						});
}
});




</script>









</body>
</html>

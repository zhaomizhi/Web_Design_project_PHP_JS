$(document).ready(function() {

			// banner swap function
			var bannerId = 1;
			var setTime = setInterval(function(){
				if(bannerId<=5){
					changeImage(bannerId);
					// changeBannerBg(bannerId);
					bannerId= bannerId+1;
				}else{
					bannerId=1;
				}
			},10000);

			// left right link-- banner
			$(".bannerhanddler").click(function(event) {
				event.preventDefault();
			});

			$("#abannerleft").click(function(event) {

				var currentBannerId = getCurrentId();

				if(currentBannerId >1){
					currentBannerId = currentBannerId-1;
					changeImage(currentBannerId);
				}
			});

			$("#abannerright").click(function(event) {
				var currentBannerId = getCurrentId();
				if(currentBannerId < 5){
					currentBannerId = currentBannerId + 1;
					changeImage(currentBannerId);
				}
			});

		
			$("#loginbuttone").click(function(event) {
				$(".beforelogin").hide('fast', function() {
				});
				if($('.login-form').css('display') == 'none'){ 
   				$('.login-form').show('slow'); 
				} else { 
  				 $('.login-form').hide('fast'); 
				}
			});
		});





		$("#loginbuttontwo").click(function(event) {
			event.preventDefault();
			var formEmail = $('#exampleInputEmail1').val();
			var password = $('exampleInputPassword1').val();
			if(formEmail == '' || password == ''){
				$(".the-return").html("Please fill the form")
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
							$('.login-form').hide('fast');
							$('.the-return').append('<p>Welcome back, ' +  data['username']+'</p>').append("<a class = 'logoutlink' href='logout.php'>Logout</a>");

							// $("#logined").append('Welcome back, ' +  data['username']);
						}
						 
					 }, 
					error: function( jqXhr, textStatus, errorThrown ){ 
						$("#loginhint").html('Please try again.');
					} 
			});
			
		});



		




		function changeBannerBg(id){
			var bg_src = "images/banner/banner_bg_" +bg_src + ".jpg";
			 $("#banner-support").css('background-image', bg_src);
		}


		function changeImage(i){
			var srcString = "images/demo1/"+ i+".jpg";
			$("#bannerimage").attr('src', srcString);
		}

		function getCurrentId(){
			var currentBannerSrc = $("#bannerimage")[0]['src'];
			var currentBannerId = currentBannerSrc.charAt(currentBannerSrc.length -5);
			return parseInt(currentBannerId);
		}
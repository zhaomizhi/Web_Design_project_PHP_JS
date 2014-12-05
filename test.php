<?php 
session_start();
echo "test";
?>
<script type="text/javascript" src = "assets/js/jquery.min.js"></script>
	<script type="text/javascript" src = "assets/js/bootstrap.min.js"></script>

<p id="demo" >Click me to change my HTML content (innerHTML).</p>
<button>Change content of all p elements</button>
<p>This is a paragraph.</p>
<p id = "haha">This is another paragraph.</p>

<script type="text/javascript">

$(document).ready(function(){
  $("button").click(function(){
    $("#haha").html("Hello <b>world!</b>");
  });
});


</script>
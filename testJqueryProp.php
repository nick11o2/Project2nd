<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<button id="1">Checkin</button><br>
<button id="2" disabled>Checkout</button>
<?php
	$datetime = date('Y-m-d H:i:s', time());
echo $datetime;
	$huyty = 'huyty,ngusi';
	$huyty_explode = explode(',',$huyty);
	echo $huyty[0];
	
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#1").click(function(){
			if($("#2").attr("disabled")){
				alert 'dd';
			}
		});
		
	});	
</script>


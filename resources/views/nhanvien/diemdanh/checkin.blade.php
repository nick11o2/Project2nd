<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, intitial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('css/materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<title>Check</title>
<head>
<?php
	$check = count($onetime);
	$calam = count($SMT);
	if($check > 0 )
	{
		header("location: ../thongtincanhan/thongtin.blade.php");
	}
	if($calam > 0)
			{
?>
				<script type="text/javascript">
					$(document).ready(function(){
						$("#submitin").prop('disabled', false);
					});	
				</script>
<?php
			}else
			{
?>
				<script type="text/javascript">
					$(document).ready(function(){
						$("#submitin").prop('disabled', true);
					});	
				</script>
<?php
			}

?>
	@if($check > 0)
		<script type="text/javascript">
			$(document).ready(function(){
				$("#submitin").prop('disabled', true);
			});	
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#submitout").prop('disabled', true);
			});	
		</script>
	@endif
<?php
		if(session()->has('checkin'))
		{
	?>
<script type="text/javascript">
		$(document).ready(function(){
			$("#submitout").prop('disabled', false);
			$("#submitin").prop('disabled', true);
		});	
</script>
	<?php 
		}else
		{
	?>
<script type="text/javascript">
		$(document).ready(function(){
			$("#submitout").prop('disabled', true);
		});	
</script>		
	<?php
		}
	?>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('hours').innerHTML =h;
    document.getElementById('minutes').innerHTML =m;
    document.getElementById('seconds').innerHTML =s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
<style>
body, html {
    height: 100%;
    margin: 0;
}

.bgimg {
    background-color: #3CCECC;
    height: 100%;
    background-position: center;
    background-size: cover;
    position: relative;
    color: white;
    font-family: "Courier New", Courier, monospace;
    font-size: 25px;
}

.topleft {
    position: absolute;
    top: 0;
    left: 16px;
}
.topright {
	position: absolute;
	top: 0;
	right: 16px;
}
.bottomleft {
    position: absolute;
    bottom: 0;
    left: 16px;
    animation: keyframebot 2s;
}
@keyframes keyframebot{
	from {left: 100vw; opacity: 0}
	to {left: 0px;opacity: 1}
}
.middle {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

hr {
    margin: auto;
    width: 40%;
}
#clockdiv{
	font-family: sans-serif;
	color: #fff;
	display: inline-block;
	font-weight: 100;
	text-align: center;
	font-size: 30px;
}

#clockdiv > div{
	padding: 10px;
	border-radius: 3px;
	background: #00BF96;
	display: inline-block;
}

#clockdiv div > span{
	padding: 15px;
	border-radius: 3px;
	background: #00816A;
	display: inline-block;
}

.smalltext{
	padding-top: 5px;
	font-size: 16px;
}
#checkbtn{
  	font-weight: 100;
  	font-size: 60px;
  	margin: 40px 0px 20px;
}
#dangxuat{
	text-decoration: none;
	color: white;
	font-size: 20px;
}
</style>
</head>
	<body onload="startTime()">

	<div class="bgimg">
	  <div class="topleft">
	    <p>Check in Dùm</p>
	  </div>
	  <div class="topright">
	  	<a href="{{route('dangxuatnhanvien')}}" id="dangxuat">Đăng xuất</a>
	  </div>
	  	<div class="middle row">
	  		<div id="checkbtn">
		  		<div class="col s6">
				    <form method="post" action="{{route('checkinprocess')}}">
					@csrf
					<input type="hidden" name="manv" value="{{session('manv')}}">
					<input type="submit" value="Checkin" id="submitin" class="waves-effect waves-light btn">
					</form>
				</div>
				<div class="col s6">
					<form method="post" action="{{route('checkoutprocess')}}">
						@csrf
						<input type="hidden" name="manv" value="{{session('manv')}}">
						<input type="submit" value="Checkout" id="submitout" class="waves-effect waves-light btn">
					</form>
				</div>
			</div>
		    <div id="clockdiv">
			  	<div>
			    	<span id="hours"></span>
			    <div class="smalltext">Giờ</div>
			  	</div>
			  	<div>
			    	<span id="minutes"></span>
			    	<div class="smalltext">Phút</div>
			  	</div>
			  	<div>
			    	<span id="seconds"></span>
			    	<div class="smalltext">Giây</div>
			  	</div>
			</div>
	  	</div>
	  	<div class="bottomleft">
	    <p>Thích Trừ Lương Không?</p>
	  	</div>
	</div>

	</body>
</html>
<script type="text/javascript">
	var colors = ['#ff0000', '#00ff00', '#0000ff'];
	var random_color = colors[Math.floor(Math.random() * colors.length)];
	document.getElementById('dangxuat').style.color = random_color;
</script>
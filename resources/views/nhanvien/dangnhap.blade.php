<!DOCTYPE html>
<html>
<head>
	<title>đăng nhập</title>
</head>
<link rel="stylesheet" type="text/css" href="{{asset('css/dangnhapnhanvien.css')}}">
<body>
	
	<div class="wrapper fadeInDown">
  		<div id="formContent">
		    <!-- Tabs Titles -->
		    <h2 class="active"> Đăng nhập </h2>
		    

		    <!-- Icon -->
		    <div class="fadeIn first">
		      <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
		    </div>

		    <!-- Login Form -->
		    <form method="post" action="{{route('dangnhapnhanvienprocess')}}">
				@csrf
				<input type="text" id="login" name="txtTaiKhoan" class="fadeIn second" placeholder="Tài khoản">
				<input type="password" id="password" name="txtMatKhau" class="fadeIn third" placeholder="Mật khẩu">
				<input type="submit" value="Đăng nhập" class="fadeIn fourth">
			</form>

		    <!-- Remind Passowrd -->
		    <div id="formFooter">
		      <a class="underlineHover" href="#">Nhanh còn Checkin</a>
		    </div>

  		</div>
	</div>
</body>
</html>

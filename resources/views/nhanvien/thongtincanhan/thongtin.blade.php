<!DOCTYPE html>
<html>
<head>
	<title>thông tin cá nhân</title>
</head>
<body>
	{{$obj->hoten}} <br>
	{{$obj->sdt}} <br>
	{{$obj->ngaysinh}} <br>
	@if($obj->gioitinh==1)
	Nam
	@endif
	@if($obj->gioitinh==0)
	Nữ
	@endif<br>
	{{$obj->tenphongban}}<br>
	{{session('taikhoan')}}<br>
	{{session('manv')}}
	<a href="{{route('dangxuatnhanvien')}}">Đăng Xuất</a>
</body>
</html>
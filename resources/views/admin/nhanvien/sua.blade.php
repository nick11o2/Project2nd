@extends('admin.theme.layout')
@section('content')
	<br>
	<form method="post" action="{{route('suanhanvienprocess')}}" id="formsub">
		@csrf
		<input type="hidden" name="manv" value="{{$obj->manv}}">
		Họ tên: <input type="text" name="txtHoTen" value="{{$obj->hoten}}"><br>
		Số điện thoại: <input type="text" name="txtSdt" value="{{$obj->sdt}}"><br>
		Ngày sinh: <input type="text" name="txtNgaySinh" value="{{$obj->ngaysinh}}"><br>
		Giới tính: 
		<label>
			<input type="radio" name="rdbGioiTinh" value="1" @if($obj->gioitinh == 1) selected @endif >
			<span>Nam</span>
		</label>
		<label>
			<input type="radio" name="rdbGioiTinh" value="0" @if($obj->gioitinh == 0) selected @endif >
			<span>Nữ</span>
		</label>
		<br>
		Phòng ban: <select name="ddlphongban" id="phongban">
			<option selected>---------</option>
			@foreach($phongbans as $phongban)
			<option value="{{$phongban->maphongban}}" @if($obj->maphongban==$phongban->maphongban) selected @endif > {{$phongban->tenphongban}} </option>
			@endforeach
		</select><br>
		Chức vụ: <select name="ddlchucvu" id="chucvu" required>
			<option selected>---------</option>
			@foreach($chucvus as $chucvu)
			<option value="{{$chucvu->machucvu}}">{{$chucvu->tenchucvu}}</option>
			@endforeach
		</select><br>
		Tiền lương: <input type="text" name="txtLuong" id="luong">
		<div class="col s12">
			Ca Làm Việc: <br><br>
			@foreach($calam as $ca)
			<label>
		        <input type="checkbox" value="{{$ca->maca}}" name="calam[]" class="filled-in" />
		        <span >Từ {{$ca->giobatdau}} Đến {{$ca->gioketthuc}}</span>
     		</label>&emsp;
			@endforeach
		</div>
		
		<input type="submit" value="Sửa" class="btn green accent-4">
		</div>
	</form>
@endsection
@section('js2')
	<script type="text/javascript">
		$(document).ready(function(){
    $('select').formSelect();
  });
		function luongtheochuc(){
			var phongban = $("#phongban").val();
			var chucvu = $("#chucvu").val();
			if(phongban == '1' && chucvu == '1') $('#luong').val(90000);
			else if(phongban == '1' && chucvu == '2') $('#luong').val(40000);
			else if(phongban == '1' && chucvu == '3') $('#luong').val(25000);
			else if(phongban == '2' && chucvu == '1') $('#luong').val(100000);
			else if(phongban == '2' && chucvu == '2') $('#luong').val(44000);
			else if(phongban == '2' && chucvu == '3') $('#luong').val(28000);
			else if(phongban == '3' && chucvu == '1') $('#luong').val(95000);
			else if(phongban == '3' && chucvu == '2') $('#luong').val(85000);
			else if(phongban == '3' && chucvu == '3') $('#luong').val(30000);
			else $('#luong').val(0);
		}
	$("select").change( luongtheochuc );
	luongtheochuc();
		function checkSubmit()
	{
		$("#formsub").validate({
			rules: {
				txtTaiKhoan: {
					required: true,
					minlength: 3
				},
				txtMatKhau: {
					required: true,
					minlength:5
				},
				txtHoTen: {
					required: true,
					name: true
				},
				txtSdt: {
					required: true,
					digits: true,
					minlength: 9,
					maxlength: 13
				},
				txtLuong: {
					required: true,
					digits: true,
					range: [20000,200000]
				},
				txtNgaySinh: {
					required: true
				},
				rdbGioiTinh: {
					required: true
				},
				calam: {
					required: true
				}
			},
			messages: {
				txtTaiKhoan: {
					required: "Không được bỏ trống",
					minlength: "tối thiểu 3 ký tự"
				},
				txtMatKhau: {
					required: "không được bỏ trống",
					minlength: "tối thiểu 5 ký tự"
				},
				txtHoTen: {
					required: "Không được bỏ trống",
					name: "tên không hợp lệ"
				},
				txtSdt: {
					required: "không được bỏ trống",
					digits: "phải là số",
					minlength: "tối thiểu 9 số",
					maxlength: "tối thiểu 13 số"
				},
				txtLuong: {
					required: "Không được bỏ trống",
					digits: "phải là số",
					range: "chỉ được nằm trong khoảng 20000 - 200000"
				},
				txtNgaySinh: {
					required: "Không được bỏ trống"
				},
				rdbGioiTinh: {
					required: "Không được bỏ trống"
				},
			}
		});
		
		return true;
	}
	@if(session()->has('message'))
	var alert='{{session('message')}}';
		M.toast({
			html:alert,
			displayLength:5000,
			classes:'pink darken-4',
		});
	@endif
	</script>
@endsection
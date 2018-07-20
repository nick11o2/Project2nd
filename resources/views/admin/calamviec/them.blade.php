@extends('admin.theme.layout')
@section('content')
	<form method="post" action="{{route('themcalamprocess')}}">
		@csrf
		<br><br>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" class="timepicker" name="giobatdau">
				<label for="giobatdau">Giờ Bắt Đầu</label>
			</div>
			<br><br>
			<div class="input-field col s12">
				<input type="text" class="timepicker" name="gioketthuc">
				<label for="gioketthuc">Giờ Kết Thúc</label>
			</div>
			<div class="input-field col s12">
				<input type="submit" value="Thêm Ca" class="btn green accent-4">
			</div>
		</div>
	</form>
@endsection
@section('js2')
	<script type="text/javascript">
		$(document).ready(function(){
    $('.timepicker').timepicker({
    	default: 'now',
    	twelveHour: false
    });
  });
	</script>
	@if(session('thongbao'))
<script>
		var alert='{{session('thongbao')}}';
		M.toast({
			html:alert,
			displayLength:5000,
			classes:'pink darken-4',
		});
</script>
@endif
@endsection
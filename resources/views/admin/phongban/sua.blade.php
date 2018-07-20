@extends('admin.theme.layout')
@section('content')
<div class="section"></div>
	<div class="row">
		<form method="post" action="{{route('suaphongbanprocess')}}" class="col s12">
			@csrf
		
				<input type="hidden" name="txtMaphongban" value="{{$phongban->maphongban}}">
			<div class="input-field col s6">
				<input type="text" id="phongban" name="txtTenphongban" value="{{$phongban->tenphongban}}" class="validate">
				<label for="phongban">Phòng ban</label>
			</div>
			<div class="input-field col s4">
				<input type="submit" value="Sửa" class="btn green accent-4">
			</div>
		</form>
	</div>
@endsection
@section('js2')
	<script type="text/javascript">
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

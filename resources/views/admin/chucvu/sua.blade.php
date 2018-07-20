@extends('admin.theme.layout')
@section('content')
<div class="section"></div>
	<div class="row">
		<form method="post" action="{{route('suachucvuprocess')}}" class="col s12">
			@csrf
		
				<input type="hidden" name="txtMachucvu" value="{{$chucvu->machucvu}}">
			<div class="input-field col s6">
				<input type="text" id="chucvu" name="txtTenchucvu" value="{{$chucvu->tenchucvu}}" class="validate">
				<label for="chucvu">Chức vụ</label>
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

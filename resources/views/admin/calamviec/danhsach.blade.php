@extends('admin.theme.layout')
@section('content')
	<div class="section"></div>
	<a href="{{route('themcalam')}}" class="btn green accent-4">Thêm Ca Làm</a>
	<table id="calam">
		<thead>
			<tr>
				<th>Ca</th>
				<th>Bắt Đầu</th>
				<th>Kết Thúc</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($arr as $obj)
			<tr>
				<td>Ca {{$obj->maca}}</td>
				<td>{{$obj->giobatdau}}</td>
				<td>{{$obj->gioketthuc}}</td>
				<td><a href="sua/{{$obj->maca}}" class="btn green accent-4">Sửa</a></td>
				<td><a href="#xoaSV-{{$obj->maca}}" class="modal-trigger btn green accent-4">Xóa</a></td>
				<!-- Modal Structure -->
				  <div id="xoaSV-{{$obj->maca}}" class="modal">
				    <div class="modal-content">
				      <h4>Xác nhận</h4>
				      <p>Giờ Bắt Đầu {{$obj->giobatdau}}</p>
				      <p>Giờ Kết Thúc {{$obj->gioketthuc}}</p>
				      <p>Bạn có chắc chắn muốn xóa Ca làm việc này không?</p>
				    </div>
				    <div class="modal-footer">
				    	<button class="btn-flat modal-action modal-close waves-effect waves-red">Hủy bỏ</button>
				      <a href="xoa/{{$obj->maca}}" class="modal-close waves-effect waves-green btn-flat">Đồng ý</a>
				    </div>
				  </div>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection
@section('js2')
	<script type="text/javascript">
		$(document).ready(function() {
$('#calam').DataTable({
responsive: true,
"language": {
		"decimal":        "",
						"emptyTable":     "Không tìm thấy dữ liệu",
						"info":           "Hiển thị từ _START_ đến _END_ trong _TOTAL_ kết quả",
						"infoEmpty":      "Hiển thị từ 0 đến 0 trong 0 kết quả",
						"infoFiltered":   "(Lọc _MAX_ tất cả)",
						"infoPostFix":    "",
						"thousands":      ",",
						"lengthMenu": '<select class="input-field" style="display:inline-block">'+
	'<option value="10">10</option>'+
	'<option value="20">20</option>'+
	'<option value="30">30</option>'+
	'<option value="40">40</option>'+
	'<option value="50">50</option>'+
	'<option value="-1">Tất cả</option>'+
'</select>',
						"loadingRecords": "Đang tải",
						"processing":     "Đang xử lý",
						"search":         "Tìm kiếm",
						"zeroRecords":    "Không tìm thấy kết quả nào phù hợp",
						"paginate": {
						"first":      "Đầu",
						"last":       "Cuối",
						"next":       "Trang kế",
						"previous":   "Quay lại"
						},
						"aria": {
						"sortAscending":  ": Kích hoạt lọc tăng dần",
						"sortDescending": ": Kích hoạt lọc giảm dần",
						}
		},
});
});
		$(document).ready(function(){
    $('.modal').modal();
  });
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
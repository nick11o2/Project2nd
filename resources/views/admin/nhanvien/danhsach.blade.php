@extends('admin.theme.layout')
@section('content')
	<div class="section"></div>
	<a href="{{route('themnhanvien')}}" class="btn green accent-4">Thêm Nhân Viên</a>
	<table id="nhanvien">
		<thead>
			<tr>

				<th>Họ Tên</th>
				<th>Điện thoại</th>
				<th>Ngày sinh</th>
				<th>Giới tính</th>
				<th>Phòng ban</th>
				<th>Chức vụ</th>
				<th>Lương theo ngày</th>
				<th>Ca Làm</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($arr as $obj)
			<tr>
				<td width="15%">{{$obj->hoten}}</td>
				<td>{{$obj->sdt}}</td>
				<td width="15%">{{$obj->ngaysinh}}</td>
				<td>@if($obj->gioitinh==1) {{'Nam'}} @endif @if($obj->gioitinh==0) {{'Nữ'}} @endif</td>
				<td>{{$obj->tenphongban}}</td>
				<td>{{$obj->tenchucvu}}</td>
				<td>{{$obj->tienluong}}</td>
				<td width="25%">
					<?php $caa = explode(',',$obj->calam);$text='' ?>
					@foreach($caa as $val)
						@foreach($calam as $ca)
						<?php $thoigian ="$text.=$ca->giobatdau.'đến '.$ca->gioketthuc"; ?>
							@if( $val==$ca->maca )
								
								<a onclick="M.toast({html: ' {{$thoigian}} '})" class="btn green accent-4">Ca {{$ca->maca}}</a>
					
							@endif
						@endforeach
					@endforeach
					{{substr($text,-9999,-2)}}
				</td>
				<td><a href="sua/{{$obj->manv}}" class="btn green accent-4">Sửa</a></td>
				<td><a href="#xoaSV-{{$obj->manv}}" class="modal-trigger btn green accent-4" >Xóa</a></td>
				<!-- Modal Structure -->
				  <div id="xoaSV-{{$obj->manv}}" class="modal">
				    <div class="modal-content">
				      <h4>Xác nhận</h4>
				      <p>Tên: {{$obj->hoten}}</p>
				      <p>Chúc vụ: {{$obj->tenphongban}}</p>
				      <p>Bạn có chắc chắn muốn xóa nhân viên này không?</p>
				    </div>
				    <div class="modal-footer">
				    	<button class="btn-flat modal-action modal-close waves-effect waves-red">Hủy bỏ</button>
				      <a href="xoa/{{$obj->manv}}" class="modal-close waves-effect waves-green btn-flat">Đồng ý</a>
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
$('#nhanvien').DataTable({
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
	$(document).ready(function(){
    $('.tooltipped').tooltip();
  });
	</script>
@endsection
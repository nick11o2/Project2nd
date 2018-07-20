@extends('admin.theme.layout')
@section('content')
	<h5>Những nhân viên đã đi làm</h5>
	<table id="thongke">
		<thead>
			<tr>
				<th width="10%">Họ tên</th>
				<th>SĐT</th>
				<th width="12%">Phòng ban</th>
				<th width="11%">Chức vụ</th>
				<th width="10%">Check-in</th>
				<th width="10%">Check-out</th>
				<th width="10%">Tình trạng</th>
				<th>Hệ số lương</th>
				<th>Giờ làm</th>
				<th width="12%"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($thongKeTrongNgay as $obj)
			<tr>
				<td>{{$obj->hoten}}</td>
				<td>{{$obj->sdt}}</td>
				<td>{{$obj->tenphongban}}</td>
				<td>{{$obj->tenchucvu}}</td>
				<td>{{$obj->checkin}}</td>
				<td>@if($obj->checkout != 'NULL'){{$obj->checkout}} @else ({{'chưa checkout'}}) @endif</td>
				<td>{{$obj->tentinhtrang}}</td>
				<td>{{$obj->hesoluong}}</td>
				<td>{{date('H',$obj->sogio)}}h</td>
				<td><a href="chitiet/{{$obj->manv}}" class="btn green accent-4" target="_blank">Chi Tiết</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="section"></div>
	<div class="divide">
		<hr>
	</div>
	<h5>Những nhân viên chưa đi làm</h5>
	<table id="thongke2">
		<thead>
			<tr>
				<th>Họ tên</th>
				<th>Ngày sinh</th>
				<th>SĐT</th>
				<th>Giới tính</th>
				<th>Phòng ban</th>
				<th>Chức vụ</th>
				<th width="12%"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($chuaDiLam as $obj)
			<tr>
				<td>{{$obj->hoten}}</td>
				<td>{{$obj->ngaysinh}}</td>
				<td>{{$obj->sdt}}</td>
				<td>@if($obj->gioitinh == 1) Nam @endif @if($obj->gioitinh == 0) Nữ @endif</td>
				<td>{{$obj->tenphongban}}</td>
				<td>{{$obj->tenchucvu}}</td>
				<td><a href="chitiet/{{$obj->manv}}" class="btn green accent-4">Chi Tiết</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection
@section('js2')
	<script type="text/javascript">
	$(document).ready(function() {
$('#thongke').DataTable({
	dom: 'Bfrtip',
				        buttons: [
				            'excel',
				            {
		            	extend: 'print',
		            	title: '',
		            	customize: function ( win ) {
	                    	$(win.document.body)
	                        .prepend(
	                            '<div align="center"><img src="{{asset('images/bachkhoa.png')}}" width="400px"/><h4>' + $('#class').text() + '</h4></div>'
                        	);
	                    }
		            },
				        ],
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
$('#thongke2').DataTable({
	
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
	
	</script>
@endsection
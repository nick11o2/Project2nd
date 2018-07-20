@extends('admin.theme.layout')
@section('css')
	<title>Thống Kê Lương Theo Tháng</title>
@endsection
@section('content')
	<div class="section">
		<div class="row">
			<div class="col s4 input-field">
				
				<select id="thang">
					@for($i=1;$i<13;$i++)
						<option value="{{$i}}">{{$i}}</option>
					@endfor
				</select>
				<label>Chọn Tháng Cần Thống Kê</label>
			</div>
		</div>
	</div>
<div id="concac"></div>
<input type="hidden" name="_token" value="{{csrf_token()}}">

@endsection

@section('js2')

	<script>
		$(document).ready(function(){
			$('select').formSelect();
		});
		$('#thang').change(function(){
			//console.log('abc');
			var value = $(this).val();
			var append = " ";
			var token = $('input[name=_token]').val();
			$.ajax({
				async: false,
				url: '{{ url('Admin/thongke/demo') }}',
				type: 'get',
				data: {
						_token: token,
						id: value,
				},
				success: function(data)
				{
					$('#thongke').DataTable({
                		destroy:true
            		});
					console.log(data);
					append += '<table id="thongke"> <thead> <tr> <th>Họ tên</th> <th>SĐT</th> <th>Phòng Ban</th> <th>Chức vụ</th> <th>Lương cơ bản</th> <th>Hệ số lương</th> <th>Tổng giờ làm</th> <th>Thực lĩnh</th> <th width="15%"></th> </tr> </thead> <tbody>';
					var tongluong = 0;
					for(var i=0;i<data.length;i++)
					{
							if(data[i].manv)
							{
								
								
								var tongsogio = Math.floor(data[i].tongsogio);
								var thuclinh = Math.floor(data[i].tienluong * data[i].heso * tongsogio);
								tongluong = tongluong += thuclinh;
								append += ' <tr><td> ' + data[i].hoten + ' </td><td> ' + data[i].sdt + ' </td><td> ' + data[i].tenphongban + '</td><td>' + data[i].tenchucvu + '</td><td>' + data[i].tienluong + '/h </td><td> ' + data[i].heso + '</td><td>' + tongsogio + 'h' + ' </td><td> ' + thuclinh + ' đ </td><td> ' + '<a href="chitiet/' + data[i].manv + '" target="_blank" class="btn green accent-4">Chi Tiết</a>' + ' </td></tr> ';

							}
					}
					append += ' </tbody> </table><br>';
					append += '<h5 class="right align">tổng lương phải trả: ' + tongluong + '</h5>';
					$('#concac').html(' ');
					$('#concac').append(append);
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
						});
				},
			});
		});

	</script>

@endsection
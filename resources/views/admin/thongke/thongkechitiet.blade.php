@extends('admin.theme.layout')

@section('content')
	<div class="section">
	<div class="row s12">
		<div class="col s4">
			<div class="card green darken-1 z-depth-3">
				<div class="card-header center-align white-text"><h3 style="font-weight: 100">Số ca nghỉ</h3></div>
				<div class="card-content center-align white-text"><p style="font-size: 30px">{{count($soCaNghi)}}</p></div>
			</div>
		</div>
		<div class="col s4 ">
			<div class="card green darken-1 z-depth-3">
				<div class="card-header center-align white-text"><h3 style="font-weight: 100;">Tổng giờ làm</h3></div>
				<div class="card-content center-align white-text"><p style="font-size: 30px">{{intval($tongGioLam[0]->sogio)}}h</p></div>
			</div>
		</div>
		<div class="col s4 ">
			<div class="card green darken-1 z-depth-3">
				<div class="card-header center-align white-text"><h3 style="font-weight: 100;">Check out sớm</h3></div>
				<div class="card-content center-align white-text"><p style="font-size: 30px">{{count($checkOutSom)}} lần</p></div>
			</div>
		</div>
	</div>
	</div>
	<div class="row">
		<div class="col s5">
			<div class="card z-depth-2">
		        <div class="card-content">
		          	<span class="card-title">Biểu Đồ Chuyên Cần</span>
	          		<canvas id="myChart" width="400" height="400"></canvas>
		        </div>
		    </div>
		</div>
		<div class="col s7">
			<div class="card z-depth-2">
				<div class="card-header">
					<div class="section">
							<h5 class="center align">Thông tin cá nhân</h5>
					</div>
				</div>
				<div class="card-content">
						<div class="row margin">
							<div class="col s3 right-align">
								Tên: 
							</div>
							<div class="col s9">
								{{$nhanvien[0]->hoten}}
							</div> 
						</div>
						<div class="row margin">
							<div class="col s3 right-align">
								Số điện thoại:
							</div>
							<div class="col s9">
								 {{$nhanvien[0]->sdt}}
							</div>
						</div>
						<div class="row margin">
							<div class="col s3 right-align">
								Ngày sinh:
							</div>
							<div class="col s9">
								  {{$nhanvien[0]->ngaysinh}}
							</div>
						</div>
						<div class="row margin">
							<div class="col s3 right-align">
								Giới tính:
							</div>
							<div class="col s9">
								  @if($nhanvien[0]->gioitinh == 1) Nam @else Nữ @endif
							</div>
						</div>
						<div class="row margin">
							<div class="col s3 right-align">
								Phòng ban: 
							</div>
							<div class="col s9">
								  {{$nhanvien[0]->tenphongban}}
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s4 input-field">
			<select id="thangthongke">
				@for($i=1;$i<13;$i++)
					<option value="{{$i}}">{{$i}}</option>
				@endfor
			</select>
			<label>Chọn Tháng Cần Thống Kê</label>
		</div>
	</div>
	<div id="thongke"></div>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<input type="hidden" name="manv" value="{{$manv}}">
@endsection

@section('js2')
	<script type="text/javascript">
		var ctx = $("#myChart");
		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				datasets: [{
					data: [ {{count($soLanDiMuon)}}, {{count($soLanDiSom)}}],
					backgroundColor: [
						'#FF4DE3',
						'#49A0EE'
					]
				}],

				labels: [
					'Muộn',
					'Đúng Giờ'
				]
			}
		});
	$(document).ready(function(){
		$('select').formSelect();
	});
	$('#thangthongke').change(function(){
		var value = $(this).val();
		var append = " ";
		var token = $('input[name=_token]').val();
		var manv = $('input[name=manv]').val();
		$.ajax({
			url: '{{ url('Admin/thongke/chiTietTheoThang') }}',
			type: 'get',
			data: {
					_token: token,
					id: value,
					manv: manv,
			},
			success: function(data)
			{
				console.log(data);
				// $('#thongke').html('abc');
				// console.log(data.thongke.dimuon);
				append += '<table id="chiTietThang"> <thead> <tr> <th> Đi muộn</th> <th> Số ca nghỉ</th> <th> Đúng giờ</th> </tr> </thead>'
				append += '<tbody> <tr> <td>'+ data.thongke.dimuon + '</td><td>' + data.thongke.canghi + '</td><td>' + data.thongke.disom + '</td> </tr>'
				append += '</tbody> </table>';
				$('#thongke').html(' ');
				$('#thongke').append(append);
				$(document).ready(function() {
						$('#chiTietThang').DataTable({

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

			}
		});
	});
	
	
	</script>
@endsection
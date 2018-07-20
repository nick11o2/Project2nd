  <nav class="light-green darken-1 z-depth-2">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center">TLCCNV</a>
  <a href="#" data-target="slide-out" class="sidenav-trigger right-align" style="display:block"><i class="material-icons">menu</i></a>

      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li></li>
    
        <li><a href="#" class='dropdown-trigger' data-target='dropdown-user' style=""><i class="material-icons nav">person</i></a></li>
      </ul>
    </div>
  </nav>
 <!-- asdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd --> 
<ul id="slide-out" class="sidenav">
    <li><div class="user-view">
      <div class="background">
        <img src="{{asset('images/backgroundAdmin.jpg')}}" width="300px" height="176px">
      </div>
      <a href="#user"><img class="circle" src="{{asset('images/user.png')}}"></a>
      <a href="#name"><span class="white-text name">BốHuyVạnTuế</span></a>
      <a href="#email"><span class="white-text email">aatroxMain@gmail.com</span></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>Chào Đại Ca</a></li>
    <li><a href="{{route('danhsachnhanvien')}}"><i class="material-icons">person</i>Quản Lý Nhân Viên</a></li>
    <li><a href="{{route('danhsachphongban')}}"><i class="material-icons">group</i>Quản Lý Phòng Ban</a></li>
    <li><a href="{{route('danhsachchucvu')}}"><i class="material-icons">assignment_ind</i>Quản Lý Chức Vụ</a></li>
    <li><a href="{{route('danhsachcalam')}}"><i class="material-icons">timer</i>Quản Lý Ca Làm</a></li>
    <li><a href="{{route('thongketrongngay')}}"><i class="material-icons">event_note</i>Thống Kê Trong Ngày</a></li>
    <li><a href="{{route('thongketheothang')}}"><i class="material-icons">dvr</i>Thống Kê Theo Tháng</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Bái Bai</a></li>
    <li><a class="waves-effect" href="{{route('dangxuatadmin')}}">Đăng xuất</a></li>
  </ul>
   <!-- asdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd --> 
  <ul id="dropdown-user" class="user dropdown-content">
      <li><a href="#"><i class="fas fa-edit"></i>Infomation</a></li>
      <li><a href="#"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
  </ul>
  @section('js')
    <script type="text/javascript">
        $(document).ready(function(){
        $('.sidenav').sidenav();
      });
        $('.dropdown-trigger').dropdown();
    </script>
  @endsection
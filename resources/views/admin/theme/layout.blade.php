<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, intitial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('css/materialize.css')}}">
  	<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
  	<link rel="stylesheet" type="text/css" href="{{asset('css/buttons.dataTables.min.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@yield('css')
</head>
<body style="background-color: #F2EEEE">
	@include('admin.theme.nav')
	<div id="content" class="container">
		@yield('content')
	</div>
	@yield('modal')
<script type="text/javascript" src="{{asset('js/Chart.bundle.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/metisMenu.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('js/buttons.flash.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('js/buttons.html5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/buttons.print.min.js')}}"></script>
	@yield('js')
	@yield('js2')
</body>
</html>
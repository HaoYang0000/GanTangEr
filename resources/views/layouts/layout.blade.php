<!DOCTYPE html>
<html>
<head>
	@include('layouts.header')

</head>
<body onload="init();">
	<div id="cloud" >
		<canvas id="canvas" ></canvas>
	</div>
	@if($flash = session('message'))
	<div class="alert alert-success" role="alert">
		{{$flash}}
	</div>
	@endif
	<div class="container" >
		@yield('content')
	</div>

	
	
</body>
</html>
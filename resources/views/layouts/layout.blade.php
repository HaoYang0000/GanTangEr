<!DOCTYPE html>
<html>
<head>
	@include('layouts.header')

</head>
<body onload="init();">
	<div id="cloud" style="height: 700px;z-index: -2; position: fixed; height: 0;">
		<canvas id="canvas" style="height: 700px;z-index: -1; position: fixed; height: 0;"></canvas>
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
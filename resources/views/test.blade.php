<!DOCTYPE html>
<html>
<head>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>
	<meta charset=utf-8/>
</head>
<body>
	<div id="bar-example"></div>

	<script>
		var len = {{$len}};
		var dates = [];
		@foreach($data as $d)
			dates.push({"month":'{{$d->month}}',"mubiao":'{{$d->mubiao}}',"shiji":'{{$d->shiji}}'});
		@endforeach

		
  		Morris.Bar({
			element: 'bar-example',

			data: dates,
			xkey: 'month',
            ykeys: ['mubiao','shiji'],//纵坐标数值变量名
			axes: true, //底标
			grid: true, //网格横线
			labels: ['目标', '实际'],
			barColors: ['#901D1D','#1D4990'],
			//stacked: false //是否重叠
			hideHover: 'true',//是否显示底标数据
			//   hoverCallback: function (index, options, content, row) {
			//     return "sin(" + row.x + ") = " + row;
			//   }, //自定义callback 方法
			gridTextColor: 'black',//底标字颜色
		});

	</script>
</body>
</html>
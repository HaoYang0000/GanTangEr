<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        

        
        <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <title>Laravel</title>

        <meta charset="utf-8"> 
        <style>
        .alt{
            color:#000000;
            background-color:#EAF2D3;
        }
        .table-hover{
            font-size:0.7em;
            text-align:left; 
            background-color:green;
            color:#ffffff;
        }
        #myTable
        {
            font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
            width:100%;
            border-collapse:collapse;
        }
        #myTable td, #myTable th 
        {
            font-size:0.7em;
            border:1px solid #98bf21;
            padding:3px 7px 2px 7px;
        }
        #myTable th 
        {
            font-size:0.7em;
            text-align:left;
            
            background-color:#A7C942;
            color:#ffffff;
        }

        #myTable td:hover
        {
            font-size:0.7em;
            text-align:left;
            cursor:pointer;
            background-color:yellow;
            color:black;
        }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif
        </div>

        <table id="myTable">
            <tr>
                <th>日期</th>
                @foreach($times as $time)
                    <th>时间</th>
                @endforeach
            </tr>
            <tr>
                <td class="week">周一</td>
                @foreach($times as $time)
                    <td class="mybox">{{$time}}</td>
                @endforeach
            </tr>
            <tr class="alt">
                <td class="week">周二</td>
                @foreach($times as $time)
                    <td class="mybox">{{$time}}</td>
                @endforeach
            </tr>
            <tr>
                <td class="week">周三</td>
                @foreach($times as $time)
                    <td class="mybox">{{$time}}</td>
                @endforeach
            </tr>
            <tr class="alt">
                <td class="week">周四</td>
                @foreach($times as $time)
                    <td class="mybox">{{$time}}</td>
                @endforeach
            </tr>
            <tr>
                <td class="week">周五</td>
                @foreach($times as $time)
                    <td class="mybox">{{$time}}</td>
                @endforeach
            </tr>
            <tr class="alt">
                <td class="week">周六</td>
                @foreach($times as $time)
                    <td class="mybox">{{$time}}</td>
                @endforeach
            </tr>
            <tr>
                <td class="week">周日</td>
                @foreach($times as $time)
                    <td class="mybox">{{$time}}</td>
                @endforeach
            </tr>
        </table>
        <br>
        
        <form action="/send" method="POST" id="dataForm">
            {{ csrf_field() }}
            <div class="class="form-group"">
            <input class="form-control" type="hidden" id="data" name="data" hidden="true">
            <label>姓名：</label><input id="name" name="name">
            </div>
        </form>

        <br>
        <div class="row">
            <div class="col-md-1">
                <button class="btn btn-success" id="myButton">确认</button>
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary" id="clear">重选</button>
            </div>
        </div>

        <script>

            $(".mybox").click(function(){
                if(rgb2hex($(this).css("color")) == "#ff0000"){
                    $(this).css("color","black");
                    $(this).css("border","1px solid #98bf21");  
                    $(this).css("border-collapse","collapse");              
                }
                else{
                    $(this).css("color","red");
                    $(this).css("border","3px solid #333");
                    $(this).css("border-collapse","collapse");
                }
            });
            //
            $("#myTable tr").hover(function(){   
                $(this).children("td").addClass("table-hover")   
            },function(){   
                $(this).children("td").removeClass("table-hover")   
            }) ;
        
            $("#myButton").click(function(){
                var counter = 0; 
                $(".mybox").each(function(){
                    if(rgb2hex($(this).css("color")) == "#ff0000"){
                        counter = counter + 1;
                        var tr = $(this).closest("tr");
                        var col_data = tr.find("td:eq(0)").text();
                        var temp = col_data+","+$(this).text()+"$"+$("#data").val();
                        $("#data").val(temp);
                        //alert(temp)
                    }
                });

                if(counter == 0){
                    alert("请选择至少一个时间！");
                }
                else if(document.getElementById('name').value == ""){
                    alert("请填写姓名！");
                }
                else{
                    document.getElementById('dataForm').submit();
                }

            });

            $("#clear").click(function(){
                $(".mybox").each(function(){
                    if(rgb2hex($(this).css("color")) == "#ff0000"){
                        $(this).css("color","black");
                        $(this).css("border","1px solid #98bf21");  
                        $(this).css("border-collapse","collapse");              
                    }
                });
            });

            function rgb2hex(rgb) {
                rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
                function hex(x) {
                    return ("0" + parseInt(x).toString(16)).slice(-2);
                }
                return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
            }

        </script>
    </body>
</html>

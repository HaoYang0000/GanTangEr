    <div id="tableHint" class="collapse" aria-expanded="true">
        <h1>请先填写或选择活动名称:</h1>
    </div>
    <div id="hiddenDiv" class="collapse">
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
    </div>
        <br>
        <div class="class="form-group"">

            <form action="/send" method="POST" id="dataForm">
                {{ csrf_field() }}
                
                <input type="hidden" id="data" name="data" hidden="true">
                <label>活动：</label><input  id="event" name="event" oninput="getMessage(this);">
                <br>
                <label>姓名：</label><input   id="name" name="name">
            </form>
            <div >
            </div>
            <table id="eventResult" name="eventResult">
                
            </table>
        </div>

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
                else if(document.getElementById('event').value == ""){
                    alert("请填写活动名！");
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

            function getMessage(event){
                if(event.value.length != 0){
                    $.ajax({
                        type:'get',
                        url:'/getmsg',
                        data: 'event='+event.value,
                        success:function(data){
                            $("#eventResult").empty();
                            for (var i = 0; i<data.length; i++) {
                                $("#eventResult").append(
                                    "<tr>"+
                                        "<td>可能的活动：</td>"+
                                        "<td class=\"col-md-8\" onclick=\"updateEvent(this);\">"+
                                        data[i]['name']+
                                        "</td>"+
                                        
                                    "</tr>"
                                );
                                //console.log(data[i])
                            }   
                        }
                    });  
                }
                else{
                    $("#eventResult").empty();
                }
                var len = document.getElementById('event').value.length;
                if(len > 0){
                    $('#tableHint').collapse('hide');
                    $('#hiddenDiv').collapse('show');
                }
                else{
                    $('#hiddenDiv').collapse('hide');
                    $('#tableHint').collapse('show');
                }
                
            }

            function updateEvent(row){
                $("#event").val(row.innerHTML);
            }
            window.onload = function() {
                $('#tableHint').collapse('show');
            };


        </script>
        


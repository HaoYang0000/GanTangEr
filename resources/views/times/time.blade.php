    <div id="tableHint" class="collapse" aria-expanded="true">
        <h1>请先填写或选择活动名称:</h1>
    </div>
    <div id="hiddenDiv" class="collapse">
        <table id="myTable" >
            <tbody>
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
            </tbody>
        </table>
    </div>
        <br>
        <div class="form-group">
            <form action="/send" method="POST" id="dataForm">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="hidden" id="data" name="data" hidden="true">
                    <label>活动：</label><input class="form-control" id="event" name="event" oninput="getMessage(this);">
                </div>
                <table id="eventResult" name="eventResult">
                   
                </table>
                <div class="input-group">
                    <label>姓名：</label><input class="form-control"  id="name" name="name">
                </div>
            </form>
            <div >
            </div>
            
        </div>

        <br>
        <div class="row">
            <div class="col-sm-2">
                <button class="send-button" id="myButton">确认</button>
            </div>
            <div class="col-sm-2">
                <button class="reset-button" id="clear">重选</button>
            </div>
        </div>

        <script>
            

            $("#myTable tr").hover(function() {
                $(this).children("td").addClass("table-hover")
            }, function() {
                $(this).children("td").removeClass("table-hover")
            });

            $("#myButton").click(function() {
                var counter = 0;
                $(".mybox").each(function() {
                    if (rgb2hex($(this).css("color")) == "#ff0000") {
                        counter = counter + 1;
                        var tr = $(this).closest("tr");
                        var col_data = tr.find("td:eq(0)").text();
                        var temp = col_data + "," + $(this).text() + "$" + $("#data").val();
                        $("#data").val(temp);
                        //alert(temp)
                    }
                });

                if (counter == 0) {
                    alert("请选择至少一个时间！");
                } else if (document.getElementById('name').value == "") {
                    alert("请填写姓名！");
                } else if (document.getElementById('event').value == "") {
                    alert("请填写活动名！");
                } else {
                    document.getElementById('dataForm').submit();
                }
            });



            function rgb2hex(rgb) {
                rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);

                function hex(x) {
                    return ("0" + parseInt(x).toString(16)).slice(-2);
                }
                return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
            }

            function getMessage(event) {
                if (event.value.length != 0) {
                    $.ajax({
                        type: 'get',
                        url: '/getmsg',
                        data: 'event=' + event.value,
                        success: function(data) {
                            $("#eventResult").empty();
                            for (var i = 0; i < data.length; i++) {
                                $("#eventResult").append(
                                    "<tr>" +
                                    "<td>可能的活动：</td>" +
                                    "<td class=\"col-md-8\" onclick=\"updateEvent(this);\">" +
                                    data[i]['name'] +
                                    "</td>" +
                                    "<td>参与人：</td>" +
                                    "<td onmouseover=\"showUserTime(this);\"" +
                                    "onmouseover=\"showUserTime(this);\"" +
                                    "onmouseout=\"cleanTableKeepRed()\">" +
                                    getUsersNameTag(data[i]) +
                                    "<input id=\"userTimes\" hidden=\"true\" value=" + getUsersTimes(data[i]) + ">" +
                                    "</td>" +
                                    "</tr>"
                                );
                                //console.log(data[i])
                            }
                        }
                    });
                } else {
                    $("#eventResult").empty();
                }
                var len = document.getElementById('event').value.length;
                if (len > 0) {
                    $('#tableHint').collapse('hide');
                    $('#hiddenDiv').collapse('show');
                } else {
                    $('#hiddenDiv').collapse('hide');
                    $('#tableHint').collapse('show');
                }
            }

            function getUsersNameTag(data) {
                var users = "";
                for (var j = 0; j < data['users'].length; j++) {
                    if (j == 0) {
                        users = "<a href=\"#\" onclick=\"getUser(this);\" onmouseover=\"getUser(this);\">" + data['users'][j]['name'] + "</a>";
                    } else {
                        users = users + "," + "<a href=\"#\" onclick=\"getUser(this);\" onmouseover=\"getUser(this);\">" + data['users'][j]['name'] + "</a>";
                    }
                }
                //<a onclick=\"getUser(this);\">"+getUsersName(data[i])+"</a>"
                return users;
            }
            var currentUser = "";
            var currentTime = "";

            function showUserTime(datas) {
                currentTime = $(datas).children("input:last-child").val();
                showUserTimeOnTable();

            }

            function cleanTable() {
                $(".mybox").each(function() {
                    //alert(rgb2hex($(this).css("color")))
                    if (rgb2hex($(this).css("color")) != "#ff0000") {
                        $(this).css("color", "black");
                        // $(this).css("border","3px solid #98bf21"); 

                    }
                });
            }

            function cleanTableKeepRed() {
                $(".mybox").each(function() {
                    if (rgb2hex($(this).css("color")) != "#000000") {
                        if (rgb2hex($(this).css("color")) != "#ff0000") {
                        
                            $(this).css("color", "#000000");
                            // $(this).css("border","3px solid #98bf21"); 

                        }
                    }
                });
            }

            $("#clear").click(function() {
                cleanTable();
            });

            function getUser(data) {
                currentUser = data.innerHTML;
            }

            function showUserTimeOnTable() {
                var index = 0;

                for (var i = 0; i < currentTime.split("#").length; i++) {
                    if (currentUser == currentTime.split("#")[i].split(";")[0]) {
                        index = i;
                        break;
                    }
                }


                //currentUser,currentTime
                var user = currentUser == currentTime.split("#")[index].split(";")[0];
                //console.log(currentTime.split("#")[index].split(";")[1]);
                var times = currentTime.split("#")[index].split(";")[1];
                var times = times.split("$");

                var trList = $("#myTable").children("tbody").children("tr");
                for (var i = 1; i < trList.length; i++) {

                    var tdArr = trList.eq(i).find("td");

                    var day = tdArr.eq(0)[0];

                    for (var j = 0; j < times.length; j++) {
                        var freeDay = times[j].split(",")[0];
                        var freeTime = times[j].split(",")[1];
                        if (freeDay == day.innerHTML) {
                            for (var k = 1; k < 16; k++) {
                                if (freeTime == tdArr.eq(k)[0].innerHTML) {
                                    tdArr.eq(k).css("color", "blue");
                                }
                            }
                        }
                    }
                }

            }

            function getUsersTimes(data) {
                var times = "";
                for (var j = 0; j < data['users'].length; j++) {
                    if (j == 0) {
                        times = data['users'][j]['name'] + ";" + data['users'][j]['times'];
                    } else {
                        times = times + "#" + data['users'][j]['name'] + ";" + data['users'][j]['times'];
                    }
                }

                return times;
            }

            function updateEvent(row) {
                $("#event").val(row.innerHTML);
            }
            window.onload = function() {
                $('#tableHint').collapse('show');
            };

            // $(".mybox").click(function() {
            //     var color = rgb2hex($(this).css("color"));
            //     console.log(color);
            //     if (color == "#ff0000") {
            //         console.log(1)
            //         $(this).css("color", "#000000");
            //         //$(this).css("background-color","white");  
            //         $(this).css("border-collapse","collapse");              
            //     }else {
            //         console.log(2)
            //         $(this).css("color", "#ff0000");
            //         //$(this).css("background-color","#33D4FF");
            //         // $(this).css("border","3px solid #333");
            //         $(this).css("border-collapse","collapse");
            //     }
            // });

            $("#myTable").selectable({
                filter: 'tbody tr td',
                selected: function(event, ui) {
                    var color = rgb2hex($(ui.selected).css("color"));
                    if (color == "#ff0000") {
                        console.log(1)
                        $(ui.selected).css("color", "#000000");
                    }else {
                        $(ui.selected).css("color", "#ff0000");
                    } 
                },
            });

            

        </script>
        


@include('layouts.cloud_background')
@include('layouts.ferrisWheel')
<div class="window" id="window">
    <div class="page0" id="page0">
        <div class="front_page_button_group">
            <button class="homeButtonCreate"  href="#createTab" data-toggle="tab">创建活动</button>
            <button class="homeButtonJoin" href="#joinTab" data-toggle="tab">加入活动</button>
        </div>

            <div class="tab-content">
                    <div id="createTab" class="tab-pane fade">
                        <form action="/create_event" method="POST" id="create_event_form">
                            {{ csrf_field() }}
                            @include('pages.page0_create')
                        </form>
                        <div class="page1" id="page1">
                            @include('pages.page1')
                        </div>


                        <div class="page2" id="page2">
                            @include('pages.page2')
                        </div>
                    </div>

                <div id="joinTab" class="tab-pane fade">
                    @include('pages.page0_join')
                </div>
            </div>
        </div>
</div>
    

    <script type="text/javascript">

    
    

    document.getElementById("backButton-page1").onclick=function(){
        moveUp((document.getElementById("page1").offsetTop),0);
    }
    document.getElementById("backButton-page2").onclick=function(){
        moveUp((document.getElementById("page2").offsetTop),(document.getElementById("page1").offsetTop));
    }

    function moveDown(speed,top){
        var timer = '';
        timer = setInterval(function(){
            var t = document.documentElement.scrollTop || document.body.scrollTop;
            if(t < top){
                if(document.documentElement.scrollTop){
                    document.documentElement.scrollTop= speed;
                }else {
                    document.body.scrollTop=speed;
                }
                speed+=10;
            }else{
                clearInterval(timer);
            }
        },10);
    }
    function moveUp(speed,top){
        var timer = '';
        timer = setInterval(function(){
            var t = document.documentElement.scrollTop || document.body.scrollTop;
            if(t > top){
                if(document.documentElement.scrollTop){
                    document.documentElement.scrollTop= speed;
                }else {
                    document.body.scrollTop=speed;
                }
                speed-=10;
            }else{
                clearInterval(timer);
            }
        },10);
    }
</script>



        <script>
            

            $("#myTable tr").hover(function() {
                $(this).children("td").addClass("table-hover")
            }, function() {
                $(this).children("td").removeClass("table-hover")
            });

            $("#confirmButton").click(function() {
                var resultCounter = 0;
                var temp = document.getElementById("mdp").value.split(",");
                var dates = $('#mdp').multiDatesPicker('getDates');
                var counter = 0;
                
                var index = 0;
                var currentDate = dates[index];
                $(".check").each(function() {
                    // if (rgb2hex($(this).css("color")) == "#ff0000") {
                    //     counter = counter + 1;
                    //     var tr = $(this).closest("tr");
                    //     var col_data = tr.find("td:eq(0)").text();
                    //     var temp = col_data + "," + $(this).text() + "$" + $("#data").val();
                    //     $("#data").val(temp);
                    //     //alert(temp)
                    // }


                    if(counter == 5){
                        index = index+1;
                        currentDate = dates[index];
                    }

                    if($(this).children().prop('checked') == true){
                        // alert($(this).text());
                        
                        resultCounter++;
                        var temp = dates[index]+","+$(this).text()+"$"+$("#data").val();
                        $("#data").val(temp);

                    }
                    

                });
                
                if (resultCounter == 0) {
                    alert("请选择至少一个具体时间！");
                } 
               
                else {
                    document.getElementById('create_event_form').submit();
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
                var temp = document.getElementById("mdp").value.split(",");
                for (var i = temp.length - 1; i >= 0; i--) {
                    $('#mdp').multiDatesPicker('removeIndexes', i);
                }
                //$("#exactTime").filter(":contains('日期')").remove();
                $("#exactTime").empty();
                //$('#mdp').multiDatesPicker('removeIndexes', 0);
                //cleanTable();
            });

            function convertDate(date){
                var result = date.split("-");

                return result[1]+"月"+result[2]+"日";
            }

            $('#affirmDate').click(function(){
                if($("#mdp").val() == ""){
                    alert("请选择至少一个日期");
                }else{


                    $("#exactTime").empty();
                    var temp = document.getElementById("mdp").value.split(",");
                    var dates = $('#mdp').multiDatesPicker('getDates');
                    for (var i = 0; i < temp.length; i++) {

                        $( "#exactTime" ).append( 
                            "<h4 class=\"page-font\">日期: "+convertDate(dates[i])+"</h4>"+
                            "<button class=\"btn btn-success check\" type=\"button\" onclick=\"checkIt(this);\">早上：8：00-10：00&nbsp;&nbsp;"
                            +"<input type=\"checkbox\" name=\"morning\"></button>&nbsp;&nbsp;"+
                            "<button class=\"btn btn-warning check\" type=\"button\" onclick=\"checkIt(this);\">中午：11：00-13：00&nbsp;&nbsp;"
                            +"<input type=\"checkbox\" name=\"morning\"></button>&nbsp;&nbsp;"+
                            "<button class=\"btn btn-info check\" type=\"button\" onclick=\"checkIt(this);\">下午：14：00-17：00&nbsp;&nbsp;"
                            +"<input type=\"checkbox\" name=\"morning\"></button>&nbsp;&nbsp;"+
                            "<button class=\"btn btn-primary check\" type=\"button\" onclick=\"checkIt(this);\">晚上：18：00-22：00&nbsp;&nbsp;"
                            +"<input type=\"checkbox\" name=\"morning\"></button>&nbsp;&nbsp;"+
                            "<button class=\"btn btn-danger check\" type=\"button\" onclick=\"checkIt(this);\">通宵：23：00-7：00&nbsp;&nbsp;"
                            +"<input type=\"checkbox\" name=\"morning\"></button>&nbsp;&nbsp;");
                    }
                    
                    var start = document.getElementById("page1").offsetTop;
                    var moveDownTarget = document.getElementById("page2");
                    var moveDownEnd = moveDownTarget.offsetTop-1;
                    moveDown(start,moveDownEnd);
                }
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
                moveUp((window.screenLeft?window.screenLeft: window.screenX),0);
                $('#tableHint').collapse('show');
            };


            $("#myTable").selectable({
                filter: 'tbody tr td',
                selected: function(event, ui) {
                    var color = rgb2hex($(ui.selected).css("color"));
                    if (color == "#ff0000") {
                        $(ui.selected).css("color", "#000000");
                    }else {
                        $(ui.selected).css("color", "#ff0000");
                    } 
                },
            });

            

        </script>
        


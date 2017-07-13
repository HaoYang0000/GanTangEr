<div class="middle-content">
            
            {{-- <label for="from">From</label>
			<input type="text" id="from" name="from">
			<label for="to">to</label>
			<input type="text" id="to" name="to"> --}}
            
                {{-- <table id="myTable" >
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
                </table> --}}
    
    <div id="page1-div"></div>
        <div class="page-content row">
        	<label class="page-font">选择日期：</label>
            <br>
            <input id="mdp">&nbsp;&nbsp;
            <button class="send-button" id="affirmDate" type="button">下一步</button>&nbsp;&nbsp;
            <button class="reset-button" id="clear" type="button">重选</button>&nbsp;&nbsp;
            <button class="reset-button" id="backButton-page1" type="button">返回上一步</button>            
        </div>                 
</div>


<script>
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
                            "<button class=\"normal-button\" type=\"button\" onclick=\"checkIt(this);\">早上：8：00-10：00&nbsp;&nbsp;"
                            +"<input type=\"checkbox\" name=\"morning\"></button>&nbsp;&nbsp;"+
                            "<button class=\"normal-button\" type=\"button\" onclick=\"checkIt(this);\">中午：11：00-13：00&nbsp;&nbsp;"
                            +"<input type=\"checkbox\" name=\"morning\"></button>&nbsp;&nbsp;"+
                            "<button class=\"normal-button\" type=\"button\" onclick=\"checkIt(this);\">下午：14：00-17：00&nbsp;&nbsp;"
                            +"<input type=\"checkbox\" name=\"morning\"></button>&nbsp;&nbsp;"+
                            "<button class=\"normal-button\" type=\"button\" onclick=\"checkIt(this);\">晚上：18：00-22：00&nbsp;&nbsp;"
                            +"<input type=\"checkbox\" name=\"morning\"></button>&nbsp;&nbsp;"+
                            "<button class=\"normal-button\" type=\"button\" onclick=\"checkIt(this);\">通宵：23：00-7：00&nbsp;&nbsp;"
                            +"<input type=\"checkbox\" name=\"morning\"></button>&nbsp;&nbsp;");
                    }
                    
                    var start = document.getElementById("page1").offsetTop;
                    var moveDownTarget = document.getElementById("page2");
                    var moveDownEnd = moveDownTarget.offsetTop-1;
                    moveDown(start,moveDownEnd);
                }
            });
	$('#mdp').multiDatesPicker({
		dateFormat: "y-m-d",
		minDate: 0,
		maxPicks: 10
	});
	$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );

        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );</script>
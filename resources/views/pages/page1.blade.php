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
        	<h3 class="page-font">选择日期：</h3>
            <input id="mdp">&nbsp;&nbsp;
            <button class="send-button" id="affirmDate" type="button">下一步</button>&nbsp;&nbsp;
            <button class="reset-button" id="clear" type="button">重选</button>&nbsp;&nbsp;
            <button class="reset-button" id="backButton-page1" type="button">返回上一步</button>            
        </div>                 
</div>


<script>
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
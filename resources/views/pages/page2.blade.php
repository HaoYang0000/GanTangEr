<div class="middle-content">
    
    <div id="page2-div"></div>
    	
        <div class="page-content row">
            <h3 class="page-font">选择具体时间：</h3>
            <div id="exactTime">
               {{--  <button class="btn btn-primary " type="button" onclick="checkIt(this);">
    			  	早上：8：00-10：00&nbsp;&nbsp;<input type="checkbox" name="morning">
    			</button>
    			<button class="btn btn-primary " type="button" onclick="checkIt(this);">
    			  	中午：11：00-13：00&nbsp;&nbsp;<input type="checkbox" name="morning">
    			</button>
    			<button class="btn btn-primary " type="button" onclick="checkIt(this);">
    			  	下午：14：00-17：00&nbsp;&nbsp;<input type="checkbox">
    			</button>
    			<button class="btn btn-primary " type="button" onclick="checkIt(this);">
    			  	晚上：18：00-22：00&nbsp;&nbsp;<input type="checkbox">
    			</button>
    			<button class="btn btn-primary " type="button" onclick="checkIt(this);">
    			  	通宵：23：00-7：00&nbsp;&nbsp;<input type="checkbox">
    			</button> --}}
            </div>
        </div>  
        <script>
        	function checkIt(button){
        		if($(button).children().prop('checked') == false){
        			$(button).children().prop('checked', true);
        		}
        		else{
        			$(button).children().prop('checked', false);
        		}
        	}

        </script>    
                
                <div class="row">
                    <br>
                    <div class="col-sm-3">
                        <button class="send-button" id="confirmButton" type="button" >创建活动</button>
                    </div>
                    <div class="col-sm-3">
                        <button class="reset-button" id="backButton-page2" type="button" >返回上一步</button>
                    </div>
                </div>
                

            
</div>


<script>

</script>
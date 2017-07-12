<div class="middle-content">
<div id="tableHint">
    <h3 class="page-font">请先填写活动名称:</h3>
</div>
<br>

        <div class="form-group">
            
                <div class="input-group">
                    <input id="data" name="data" hidden="true">
                    <label class="page-font">活动名称：</label>
                    <br>
                    <input class="custom-input" id="event" name="event" >
                    <br>
                    <label class="page-font">创建人： </label>
                    <br>
                    <input class="custom-input"  id="name" name="name">
                    <br>
                    <label class="page-font">是否对所有人可见：</label>
                    <br>
                    <label class="page-font">是：</label>
                    <input type="radio" id="if_private" name="if_private" value=0 checked>
                    &nbsp;&nbsp;
                    <label class="page-font">否：</label>
                    <input type="radio" id="if_private" name="if_private" value=1>
                </div>
           
        </div>
        <div class="row">
            <div class="col-sm-2">
                <button class="send-button" id="nextButton-page0" type="button">下一步</button>
            </div>
        </div>
</div>
<script type="text/javascript">
    document.getElementById("nextButton-page0").onclick=function(){
        if($('#event').val() == ""){
            alert("请填写活动名称！");
        }
        else if($('#name').val() == ""){
            alert("请填写姓名！");
        }
        else{
            var next = document.getElementById("nextButton-page0");

            var moveDownTarget = document.getElementById("page1");
            //var oTarget_Top = 1375;
            moveDownEnd = moveDownTarget.offsetTop;
            moveDown(1,moveDownEnd);
        } 
    }
</script>






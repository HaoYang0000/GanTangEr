@if(!empty(session('success')))
<script type="text/javascript">
	 setTimeout(function(){
	 	$("#session").fadeOut(5000);
	 },1000);
	
</script>

<div id="session" style="position:absolute;z-index: 99; top: 20vh; left: 0; right: 0; margin: 0 auto; text-align: center; background-color: green; height: 7vh; width: 40vh; line-height: 6vh;   border-top-right-radius:2vh; border-top-left-radius:2vh; border-bottom-left-radius:2vh; border-bottom-right-radius:2vh;  font-family: Arial;
          color: #ffffff;
          font-size: 4vh;">
	{{session('success')}}
</div>
@endif

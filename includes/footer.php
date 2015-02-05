</div>
<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
<script src="<?=mypath?>js/jquery.mCustomScrollbar.min.js"></script>
<script src="<?=mypath?>royalslider/jquery.royalslider.min.js" ></script>
<script src="<?=mypath?>js/bootstrap.min.js"></script>
<script src="<?=mypath?>js/outdatedBrowser.min.js"></script>	
<?php
if(strstr($_SERVER['HTTP_USER_AGENT'],'Android') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) {
?>
<script>
console.log('IOS/ANDROID')
	var ipad = true;
</script>
<?php
}else{
?>
<script>
	var ipad = false;
</script>
<?php
}
?>
<script src="<?=mypath?>js/scripts.js"></script>
</body>
</html>
<script>
    function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function() {
            oldonload();
            func();
        }
    }
}
//call plugin function after DOM ready
addLoadEvent(
    outdatedBrowser({
        bgColor: '#f25648',
        color: '#ffffff',
        lowerThan: 'transform'
    })
    );

//USING jQuery
$( document ).ready(function() {
    outdatedBrowser({
        bgColor: '#f25648',
        color: '#ffffff',
        lowerThan: 'transform'
    })
})
</script>
<script>
/*
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-24233015-24', 'locker.com.mx');
  ga('send', 'pageview');
*/
</script>
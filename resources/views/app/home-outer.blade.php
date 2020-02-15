<!DOCTYPE html>
<html dir="rtl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>جدول المباريات</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">

    <link rel="stylesheet" type="text/css" href="/css/home.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/droidarabickufi.css">
</head>
<body>

<div class="alba-live-table">

    <div class="box-title">
        <h2 class="title">
        	<i class="fa fa-futbol-o" aria-hidden="true"></i> مباريات اليوم
        </h2>
        <button type="button" class="btn btn-sm btn-default" id="reload_prog" onClick="reload();">
         	<i class="fa fa-repeat"></i> اعادة تحميل 
        </button>
        <span class="pull-left" dir="ltr" id="current_time"></span>
    </div>

	<div id="iframe-container">
		<iframe 
		style="height: 100vh"
		allowfullscreen="allowfullscreen" 
		allowtransparency="true" 
		frameborder="0" 
		marginheight="0"
		marginwidth="0" 
		scrolling="no" 
		src="/home-inner"
		width="100%"
		height="100%"
		onload="resizeIframe(this)">
		</iframe>
	</div>

</div>

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/moment.min.js"></script>
<script type="text/javascript" src="/js/moment-timezone-with-data.min.js"></script>
<script type="text/javascript" src="/js/twix.min.js"></script>
<script type="text/javascript" src="/js/mobile-detect.min.js"></script>
<script type="text/javascript" src="/js/index.js"></script>
<script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>

</body>
</html>
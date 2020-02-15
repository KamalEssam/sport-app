
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $server->channel->name.' - '. $server->name }}">
    <meta name="keywords" content="{{ $server->channel->name.','. $server->name }}">
    <title>{{ $server->channel->name.' - '. $server->name }}</title>
    <link href="/css/live.css" rel="stylesheet" type="text/css" />
    <script src="/js/jquery.js" type="text/javascript"></script>
    <style type="text/css">
        html {
            height: 100%;
            width: 100%; 
        }
        body {
            margin: 0px;
            padding: 0px;
            height: 100%;
            width: 100%; 
            overflow-x: hidden; 
            text-align: center;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <?php 
    function isMobile() 
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    ?>

    <div id="root">
        @if($server->ads_block == 1)
            <iframe 
            allowfullscreen="allowfullscreen" 
            allowtransparency="true" 
            frameborder="0" 
            marginheight="0"
            marginwidth="0" 
            sandbox="allow-forms allow-same-origin allow-scripts" 
            scrolling="no" 
            src="/iframe-inner/{{ $server->id }}"
            width="100%"
            height="100%">
        </iframe>
        @else
            <iframe 
            allowfullscreen="allowfullscreen" 
            allowtransparency="true" 
            frameborder="0" 
            marginheight="0"
            marginwidth="0" 
            scrolling="no" 
            src="/iframe-inner/{{ $server->id }}"
            width="100%"
            height="100%">
            </iframe>
        @endif

        @if($adsense->video_code_active == 1)
        <div id="adsense">
            <div id="adsense_code">
                <?php echo $adsense->video_code; ?>
            </div>
        </div>
        @endif

        @if(isMobile() && $adsense->mobile_code_active == 1)
            <?php echo $adsense->mobile_code; ?>
        @elseif(!isMobile() && $adsense->desktop_code_active == 1)
            <?php echo $adsense->desktop_code; ?>
        @endif

        <script>
        var adsense = <?php echo json_encode($adsense); ?>;
        $(function () 
        {
            if(adsense.video_code_active == 1)
            {
                setInterval(function()
                {
                    var adsCode = '<div id="adsense">';
                    adsCode += '<div id="adsense_code">';
                    adsCode += '<?php echo $adsense->video_code; ?>';
                    adsCode += '</div>';
                    adsCode += '</div>';

                    if(!$('#adsense').length)
                    {
                        $('#root').append(adsCode);
                    }
                    setInterval(function()
                    {
                        var adsCodeClose = '<span onClick="closeAds();">X</span>';
                        if(!$('#adsense span').length)
                        {
                            $('#adsense').append(adsCodeClose);
                        }
                    }, 5000);

                }, 1800000);

                setTimeout(function()
                {
                    var adsCodeClose = '<span onClick="closeAds();">X</span>';
                    if(!$('#adsense span').length)
                    {
                        $('#adsense').append(adsCodeClose);
                    }
                }, 5000);
            }
        });

        function closeAds()
        {
            $("#adsense").remove();
        }

        </script>

    </div>
</html>

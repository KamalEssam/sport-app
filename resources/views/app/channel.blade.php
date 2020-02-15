<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/app.css" rel="stylesheet" type="text/css" />
    <link href="/css/live.css" rel="stylesheet" type="text/css" />
    <link href="/css/owl.carousel.css" rel="stylesheet" type="text/css" />
    <title>{{ $channel->name}}</title>
    <script src="/js/jquery.js" type="text/javascript"></script>
</head>
<body>

    <?php 
    function isMobile() 
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    ?>

    <div class="container">
        <div class="row justify-content-center" style="direction:rtl;">
        
            <div class="col-12">
                @if(isset($channel->servers[0]))
                <ul class="quality">
                    @foreach($channel->servers as $i => $server)
                    <li id="{{ $i }}" onClick="setQuality(this.id)" class="{{ $i == 0 ? 'active' : '' }}" style="{{ $i == 0 ? 'border-top-right-radius:4px' : '' }}">
                        @switch($server->quality)
                            @case('MAIN')
                            <span class="quality-word">البث </span>الرئيسي
                            @break
                            @case('HIGH')
                            <span class="quality-word">جودة </span>عالية
                            @break
                            @case('MEDIUM')
                                <span class="quality-word">جودة </span>متوسطة
                            @break
                            @case('LOW')
                            <span class="quality-word">جودة </span>منخفضة
                            @break
                        @endswitch
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>

            @if(isset($channel->servers[0]))
            <div class="col-12">
                <div id="owl" class="owl-carousel owl-theme">
                    <?php $featuredArr = []; ?>
                    <?php $unFeaturedArr = []; ?>
                    @foreach($channel->servers[0]->servers as $i => $server)
                        @if( (isMobile() && $server->work_on != 'DESKTOP') || (!isMobile() && $server->work_on != 'MOBILE'))
                        <?php $server->is_featured == 1 ? $featuredArr[] = $i : $unFeaturedArr[] = $i ;?>
                        <div id="{{ $i }}" onClick="setServer(this.id)" class="item">{{ $server->name }}</div>
                        @endif
                    @endforeach
                </div>
            </div>
            
            <?php $index = count($featuredArr) > 0 ? $featuredArr[array_rand($featuredArr)] : $unFeaturedArr[array_rand($unFeaturedArr)]; ?>
            
            <script>
            $(".item[id="+{{ $index }}+"]").addClass('item-active');
            </script>
            @endif

            @if(isset($channel->servers[0]))
            <div class="col-12">
                <div class="video" style="height: calc(100vh - 175px) !important;">
                    <div id="root">
                        <div id="iframe">
                        @if(isset($channel->servers[0]->servers[0]))
                            <?php $server = $channel->servers[0]->servers[$index]; ?>                                
                            <iframe 
                            sandbox="allow-scripts allow-same-origin allow-presentation allow-popups allow-modals allow-top-navigation"
                            allowfullscreen="allowfullscreen" 
                            allowtransparency="true" 
                            frameborder="0" 
                            marginheight="0"
                            marginwidth="0" 
                            scrolling="no" 
                            src="/iframe-outer/{{ $server->id }}"
                            width="100%"
                            height="100%">
                            </iframe>
                        @endif
                        </div>

                        <button class="btn btn-refresh" onClick="refresh();">
                            تحديث <img src="/live-assets/refresh.png" />
                        </button>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

    <script src="/js/owl.carousel.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="/js/mobile-detect.min.js"></script>
    <script>
    $('.owl-carousel').owlCarousel({
        rtl:true,
        loop:false,
        margin:15,
        nav:true,
        responsive:{
            0:{ items:3 },
            600:{ items:4 },
            1000:{ items:7 }
        }
    });
    
    var channel  = <?php echo json_encode($channel) ?>;
    var quality  = 0;
    var server   = 0;
    var code     = '';

    var featuredArr = [];
    var unFeaturedArr = [];
    var index = 0;

    var md = new MobileDetect(window.navigator.userAgent);

    function setQuality(id)
    {
        quality = id;

        featuredArr = [];
        unFeaturedArr = [];
        index = 0;

        $(".quality li").removeClass('active');
        $(".quality [id='"+quality+"']").addClass('active');

        // *** START SERVER SECTION
        $('.owl-item').remove();
        $('.owl-carousel').trigger('destroy.owl.carousel');
        channel.servers[quality].servers.forEach(function(server, i) 
        {
            if((md.mobile() && server.work_on != 'DESKTOP') || (!md.mobile() && server.work_on != 'MOBILE'))
            {
                if(server.is_featured == 1){
                    featuredArr.push(i);
                }else{ 
                    unFeaturedArr.push(i);
                }
                $(".owl-carousel").append('<div id="'+i+'" onClick="setServer(this.id)" class="item">'+server.name+'</div>');
            }
        });
        
        $('.owl-carousel').owlCarousel({
            rtl:true, loop:false, margin:15, nav:true,
            responsive:{ 0:{ items:3 }, 600:{ items:4 }, 1000:{ items:7 } }
        });
        // *** END SERVER SECTION

        index = featuredArr.length > 0 ? featuredArr[Math.floor(Math.random()*featuredArr.length)] : unFeaturedArr[Math.floor(Math.random()*unFeaturedArr.length)];

        $(".item[id="+index+"]").addClass('item-active');

        setServer(index);
    }

    function setServer(id)
    {
        server = id;
        $(".item").removeClass('item-active');
        $(".item[id='"+server+"']").addClass('item-active');

        var serverId = channel.servers[quality].servers[server].id;
            code = '<iframe';
            code += ' sandbox="allow-scripts allow-same-origin allow-presentation allow-popups allow-modals allow-top-navigation"';
            code += ' allowfullscreen="allowfullscreen"';
            code += ' allowtransparency="true"';
            code += ' frameborder="0"'; 
            code += ' marginheight="0"';
            code += ' marginwidth="0"'; 
            code += ' scrolling="no"';
            code += ' src="/iframe-outer/'+serverId+'"';
            code += ' width="100%"';
            code += ' height="100%">';
            code += '</iframe>';
        $("#iframe").html(code);
    }

    function copyCode()
    {
        var dummy = document.createElement("input");
        document.body.appendChild(dummy);
        dummy.value = $("#iframe").html();
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
    }

    function refresh()
    {
        $("#iframe").html($("#iframe").html());
    }

    function switchQuality(title)
    {
        switch(title){
            case 'MAIN':
                text = '<span class="quality-word">البث </span>الرئيسي';
                break; 
            case 'HIGH':
                text = '<span class="quality-word">جودة </span>عالية';
                break;
            case 'MEDIUM':
                text = '<span class="quality-word">جودة </span>متوسطة';
                break;
            case 'LOW':
                text = '<span class="quality-word">جودة </span>منخفضة';
                break; 
            default: 
                text = '';
            }
        return text;
    }
    </script>
</body>
</html>

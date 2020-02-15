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

<?php 
function isMobile() 
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>

<div id="content_html">
    @foreach($leagues as $league)
    <div class="new-league-head">
        <div class="title-aria">
            <div class="title-imag">
                <h6 class="league-title">{{ $league->name }}</h6>
            </div>
        </div>
    </div>
    <div class="scores-parent " id="championship_32">
        @foreach($league->matches as $match)
        <div class="alba_sports_events-event_item" rel="{{ $match->id }}">
            <a href="{{ isMobile() ? ($match->blog_mobile_url != '' ? $match->blog_mobile_url : $match->blog_desktop_url) : $match->blog_desktop_url }}" target="_blank" title="{{ $match->localteam_name }} vs {{ $match->visitorteam_name }}">
                <div class="alba_sports_events-event_mask">
                    <div class="event_mask_inner">
                        @if(in_array($match->status, ['LIVE', 'HT']))
                        <div class="h3 alba_sports_events-event_mask_inner_text">شاهد المباراة الان</div>
                        @elseif(in_array($match->status, ['FT', 'AET', 'FT_PEN']))
                        <div class="h3 alba_sports_events-event_mask_inner_text">انتهت المباراة</div>
                        @else
                        <div class="h3 alba_sports_events-event_mask_inner_text">لم تبدأ بعد</div>
                        @endif
                    </div>
                </div>
                <div class="event_inner">
                    <div class="team-aria team-first">
                        <div class="alba-team_logo">
                            <img alt="{{ $match->localhome_name }}" src="/uploads/teams/{{ $match->localteam_logo }}">
                        </div>
                        <div class="alba_sports_events-team_title">{{ $match->localteam_name }}</div>
                    </div>

                    @if(in_array($match->status, ['LIVE', 'HT']))
                    <div class="width live">
                        <span>{{ $match->localteam_score }} - {{ $match->visitorteam_score }}</span>
                    </div>
                    @elseif(in_array($match->status, ['FT', 'AET', 'FT_PEN']))
                    <div class="width finshed">
                        <span>{{ $match->localteam_score }} - {{ $match->visitorteam_score }}</span>
                    </div>
                    @else
                    <div class="width">
                        <span>vs</span>
                    </div>
                    @endif

                    <div class="team-aria team-second">
                        <div class="alba-team_logo">
                            <img alt="{{ $match->visitorteam_name }}" src="/uploads/teams/{{ $match->visitorteam_logo }}">
                        </div>
                        <div class="h2 alba_sports_events-team_title">{{ $match->visitorteam_name }}</div>
                    </div>
                </div>
                <div class="events-info blu">
                    <span class="event_time match_date_time" title="{{ $match->date_time }}" rel="0">
                        <i aria-hidden="true" class="fa fa-clock-o"></i> 
                        @if(in_array($match->status, ['LIVE', 'HT']))
                        <p class="live">مباشر</p> 
                        @elseif($match->status == 'NS')
                        {{ date('h:i A', strtotime($match->date_time)) }}
                        @elseif($match->status == 'POSTP')
                        <p class="">تأجلت</p>
                        @elseif(in_array($match->status, ['FT', 'AET', 'FT_PEN']))
                        <p class="finshed">انتهت</p>
                        @endif
                    </span>
                    <span class="event_commenter">
                        <i aria-hidden="true" class="fa fa-microphone"></i>  
                        @foreach($match->commentators as $i => $commentator)
                            {{ $commentator->name }} {{ ($i+1) == count($match->commentators->toArray()) ? '' : ' - ' }}
                        @endforeach
                    </span>
                    <span class="event_chanel">
                        <i aria-hidden="true" class="fa fa-television"></i>
                        @foreach($match->commentators as $i => $commentator)
                            @foreach($commentator->channels as $ii => $channel)
                            {{ $channel->name }} {{ ($ii+1) == count($commentator->channels->toArray()) ? '' : ' - ' }}
                            @endforeach
                        @endforeach
                    </span>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endforeach
</div>

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/moment.min.js"></script>
<script type="text/javascript" src="/js/moment-timezone-with-data.min.js"></script>
<script type="text/javascript" src="/js/twix.min.js"></script>
<script type="text/javascript" src="/js/mobile-detect.min.js"></script>

</body>
</html>
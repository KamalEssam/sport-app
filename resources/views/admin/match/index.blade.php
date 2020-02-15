@extends('admin.layouts.app')
@section('title','المباريات')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ $message }}
</div>
@endif

<!--begin:: Widgets/Application Sales-->
<div class="m-portlet m-portlet--full-height  m-portlet--unair">
    

    <div class="m-portlet__head">
		<div class="m-portlet__head-caption"  style="width:70%;">                
            <form method="get" action="/admin/matches" style="width:100%;">
                <div class="row">

                    <div class="col-md-4">
                        <div class="input-group date">
                            <input autocomplete="off" type="text" class="form-control m-input m_datetimepicker_6" placeholder="التاريخ" name="date" value="{{ isset($_GET['date']) ? $_GET['date'] : '' }}" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                <i class="la la-calendar glyphicon-th"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-success">تصفية المباريات</button>
                    </div>

                </div>
            </form>
        </div>
        
        <div class="m-portlet__head-tools">
            @if(auth()->user()->can('CREATE_MATCHES'))
            <form action="/admin/matches" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-primry">تحديث</button>
            </form>
            @endif
        </div>

    </div>


    <div class="m-portlet__body">
        <div class="tab-content">

            <!--begin::Widget 11--> 
            <div class="m-widget11">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-striped m-table">
                        <!--begin::Thead-->
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>التاريخ</td>
                                <td>الفريق المستضيف</td>
                                <td>النتيجة</td>
                                <td>الفريق الضيف</td>
                                <td>البطولة</td>
                                <td>الحالة</td>
                                <td>اسم الرابط</td>
                                <td>معاينة</td>
                                <td>نسخ</td>
                                @if(auth()->user()->can('UPDATE_MATCHES'))
                                <td>تعديل</td>
                                @endif
                                @if(auth()->user()->can('DELETE_MATCHES'))
                                <td>حذف</td>
                                @endif
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody>
                            @if(count($matches) > 0)
                                @foreach($matches as $match)
                                <tr>
                                    <td>{{ $match->id }}</td>
                                    <td>{{ $match->date_time }}</td>
                                    <td>{{ $match->localteam_name }}</td>
                                    <td>{{ $match->localteam_score }} - {{ $match->visitorteam_score }}</td>
                                    <td>{{ $match->visitorteam_name }}</td>
                                    <td><a href="/admin/leagues/{{ $match->league->id}}/edit">{{ $match->league->name }}</a></td>
                                    <td>
                                        @switch($match->status)
                                            @case('NS')
                                                لم تبدأ
                                                @break
                                            @case('LIVE')
                                                جارية الآن
                                                @break
                                            @case('HT')
                                                انتهاء الشوط الأاول
                                                @break
                                            @case('FT')
                                                انتهت
                                                @break
                                            @case('ET')
                                                وقت أضافي
                                                @break
                                            @case('PEN_LIVE')
                                                ضربات الترجيح
                                                @break
                                            @case('AET')
                                                انتهت بعد الوقت الأضافي
                                                @break
                                            @case('BREAK')
                                                استراحة
                                                @break
                                            @case('FT_PEN')
                                                انتهت بعد ضربات الترجيح
                                                @break
                                            @case('POSTP')
                                                تأجلت
                                                @break
                                            @case('Deleted')
                                                محذوفه
                                                @break
                                            @default
                                                {{ $match->status }}
                                        @endswitch
                                    </td>
                                    <td>{{ $match->slug }}</td>
                                    <td><a href="/matches/{{ $match->slug != '' ? $match->slug : $match->id }}" target="_blank">معاينة</a></td>
                                    <td>
                                        <button data-width={{ isset($match->commentators[1]) ? '915px' : '870px' }} data-id="{{ $match->slug != '' ? $match->slug : $match->id }}" class="btn btn-sm btn-primary" onClick="copy(this)">نسخ</button>
                                    </td>
                                    @if(auth()->user()->can('UPDATE_MATCHES'))
                                    <td>
                                        <a href="/admin/matches/{{ $match->id }}/edit">
                                            <button type="submit" class="btn btn-sm btn-info">
                                                <i class="flaticon-edit"></i>
                                            </button>
                                        </a>
                                    </td>
                                    @endif
                                    @if(auth()->user()->can('DELETE_MATCHES'))
                                    <td>
                                        <form action="/admin/matches/{{ $match->id }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="flaticon-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11" style="text-align:center">لا توجد نتائج</td>
                                </tr>
                            @endif

                        </tbody>
                        <!--end::Tbody-->  

                    </table>
                    <!--end::Table-->                        
                </div>
                <div class="m-widget11__action m--align-right">
                {{ $matches->appends($_GET)->links() }}
                </div>
            </div>
            <!--end::Widget 11-->

        </div>
    </div>

</div>
<!--end:: Widgets/Application Sales-->  

<script>
function copy(value)
{
    var matchId  = $(value).data('id');
    var protocol = location.protocol;
    var slashes  = protocol.concat("//");
    var host     = slashes.concat(window.location.hostname);
    var url      = host.concat("/matches/"+matchId);
    var code = '<iframe allowfullscreen="" scrolling="no" ';
        code += 'frameborder="0" ';
        code += 'src="'+url+'" height="'+$(value).data('width')+'" width="100%"></iframe>';
    var dummy = document.createElement("input");
    document.body.appendChild(dummy);
    dummy.value = code;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
}
</script>
@endsection
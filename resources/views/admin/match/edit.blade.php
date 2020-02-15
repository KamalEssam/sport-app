@extends('admin.layouts.app')
@section('title','تعديل مباراة')

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">
            
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">تعديل مباراة</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/admin/matches/{{ request()->route('match') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT" />

                    <div class="form-group row">
                        <label class="col-3 col-form-label">التاريخ</label>
                        <div class="col-9">
                            <input disabled class="form-control m_datetimepicker_6" name="date_time" value="{{ date('Y-m-d', strtotime($match->date_time)) }}" placeholder="التاريخ" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">التوقيت</label>
                        <div class="col-9">
                            <input disabled class="form-control m_datetimepicker_7" name="time" value="{{ date('H:i', strtotime($match->date_time)) }}" placeholder="التوقيت" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">البطولة</label>
                        <div class="col-9">
                            <select disabled class="form-control" name="league_id">
                                <option value="{{ $match->league->id }}">{{ $match->league->name }}</option>
                            </select>
                            @if ($errors->has('league_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('league_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">الفريق المستضيف</label>
                        <div class="col-9">
                            <select class="form-control" name="localteam_name" disabled>
                                <option value="{{ $match->localteam_name }}">{{ $match->localteam_name }}</option>
                            </select>
                            @if ($errors->has('localteam_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('localteam_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">الفريق الضيف</label>
                        <div class="col-9">
                            <select class="form-control" name="visitorteam_name" disabled>
                                <option value="{{ $match->visitorteam_name }}">{{ $match->visitorteam_name }}</option>
                            </select>
                            @if ($errors->has('visitorteam_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('visitorteam_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">أهداف الفريق المستضيف</label>
                        <div class="col-5">
                            <input disabled class="form-control" type="number" name="localteam_score" value="{{ $match->localteam_score }}" placeholder="الأهداف" />
                        </div>
                        <div class="col-4">
                            <input disabled class="form-control" type="number" name="localteam_pen_score" value="{{ $match->localteam_pen_score }}" placeholder="ركلات الترجيح" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">أهداف الفريق الضيف</label>
                        <div class="col-5">
                            <input disabled class="form-control" type="number" name="visitorteam_score" value="{{ $match->visitorteam_score }}" placeholder="الأهداف" />
                        </div>
                        <div class="col-4">
                            <input disabled class="form-control" type="number" name="visitorteam_pen_score" value="{{ $match->visitorteam_pen_score }}" placeholder="ركلات الترجيح" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">الحالة</label>
                        <div class="col-9">
                            <select class="form-control" name="status" disabled>
                                <option value="{{ $match->status }}">
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
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">المعلق</label>
                        <div class="col-9">
                            @if(count($match->commentators) > 0)
                                <?php $x = 0; ?>
                                @foreach($match->commentators as $commentator)
                                <div class="commentator">
                                    <input type="text" class="form-control" name="commentators[{{$x}}][name]" value="{{ $commentator['name'] }}" placeholder="اسم المعلق" />
                                    <br/>
                                    <div class="row">
                                        @for($i=0; $i < 4; $i++)
                                        <div class="col-6">
                                            <select class="form-control" name="commentators[{{$x}}][channels][{{$i}}]">
                                                <option value="">اختر قناة {{$i+1}}</option>
                                                @foreach($channels as $channel)
                                                    <option {{ isset($commentator->channels[$i]) && $commentator->channels[$i]->id == $channel->id ? 'selected' : '' }} value="{{ $channel->id }}">{{ $channel->name }}</option>
                                                @endforeach
                                            </select>
                                            <br/>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                                <?php $x++; ?>
                                @endforeach
                            @else
                                <div class="commentator">
                                    <input type="text" class="form-control" name="commentators[0][name]" value="" placeholder="اسم المعلق" />
                                    @if ($errors->has('commentators.*.name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('commentators.*.name') }}</strong>
                                        </span>
                                    @endif
                                    <br/>
                                    <div class="row">
                                        @for($i=0; $i < 4; $i++)
                                        <div class="col-6">
                                            <select class="form-control" name="commentators[0][channels][{{$i}}]">
                                                <option value="">اختر قناة {{$i+1}}</option>
                                                @foreach($channels as $channel)
                                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                                @endforeach
                                            </select>
                                            <br/>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            @endif

                            <div id="addCommentator" data-count="{{ count($match->commentators) == 0 ? 1 : count($match->commentators) }}"></div>

                            <a href="javascript:void(0);" class="btn btn-success" onClick="addCommentator(this)">أضافة معلق</a>

                            <a href="javascript:void(0);" class="btn btn-danger" style="{{ count($match->commentators) == 0 || count($match->commentators) == 1 ? 'display:none' : '' }}" id="removeCommentator" onClick="removeCommentator(this)">حذف معلق</a>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3 col-form-label">رابط بلوجر كمبيوتر</label>
                        <div class="col-9">
                            <input class="form-control" type="text" name="blog_desktop_url" value="{{ $match->blog_desktop_url }}" placeholder="رابط بلوجر كمبيوتر" />
                            @if ($errors->has('blog_desktop_url'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('blog_desktop_url') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">رابط بلوجر موبايل</label>
                        <div class="col-9">
                            <input class="form-control" type="text" name="blog_mobile_url" value="{{ $match->blog_mobile_url }}" placeholder="رابط بلوجر موبايل" />
                            @if ($errors->has('blog_mobile_url'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('blog_mobile_url') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">اسم الرابط</label>
                        <div class="col-9">
                            <input class="form-control" name="slug" value="{{ $match->slug }}" placeholder="اسم الرابط" />
                            @if ($errors->has('slug'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primry" value="تعديل" />
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <!--end::Portlet-->
	</div>


</div>



@endsection

@section('scripts')
<script type="text/javascript">
    
    function addCommentator(value)
    {
        $("#removeCommentator").show();
        let count = $("#addCommentator").attr('data-count');
        let html  = '<div class="commentator">';
            html += '<input type="text" class="form-control" name="commentators['+(count)+'][name]" placeholder="اسم المعلق" />';
            html += '<br/>';
            html += '<div class="row">';
            html += '@for($i=0; $i < 4; $i++)';
            html += '<div class="col-6">';
            html += '<select class="form-control" name="commentators['+count+'][channels][{{$i}}]">';
            html += '<option value="">اختر قناة {{$i+1}}</option>';
            html += '@foreach($channels as $channel)';
            html += '<option value="{{ $channel->id }}">{{ $channel->name }}</option>';
            html += '@endforeach'
            html += '</select>'
            html += '<br/>';
            html += '</div>';
            html += '@endfor';
            html += '</div>';
            html += '</div>';
        $("#addCommentator").append(html);   
        $("#addCommentator").attr('data-count', ++count); 
    }

    function removeCommentator(value)
    {
        let count = $("#addCommentator").attr('data-count'); 
        if(count > 1)
        {
            $("#addCommentator > div").last().remove();
            $("#addCommentator").attr('data-count', --count); 
            if(count == 1)
            {
                $("#removeCommentator").hide();
            }
        }
    }
</script>
@endsection
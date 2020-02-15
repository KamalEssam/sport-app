@extends('admin.layouts.app')
@section('title','أضافة سيرفر')

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">أضافة سيرفر</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/admin/servers" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">الاسم</label>
                        <div class="col-9">
                            <input class="form-control" name="name" value="{{ old('name') }}" placeholder="الاسم" />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">نوع الجودة</label>
                        <div class="col-9">
                            <select class="form-control" name="quality">
                                <option value="">اختر نوع الجودة</option>
                                <option {{ old('quality') == 'MAIN' ? 'selected' : '' }} value="MAIN">البث الرئيسي</option>
                                <option {{ old('quality') == 'HIGH' ? 'selected' : '' }} value="HIGH">جودة عالية</option>
                                <option {{ old('quality') == 'MEDIUM' ? 'selected' : '' }} value="MEDIUM">جودة متوسطة </option>
                                <option {{ old('quality') == 'LOW' ? 'selected' : '' }} value="LOW">جودة منخفضة </option>
                            </select>
                            @if ($errors->has('quality'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('quality') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">يعمل علي</label>
                        <div class="col-9">
                            <select class="form-control" name="work_on">
                                <option value="">اختر يعمل علي</option>
                                <option {{ old('work_on') == 'ALL' ? 'selected' : '' }} value="ALL">الكل</option>
                                <option {{ old('work_on') == 'DESKTOP' ? 'selected' : '' }} value="DESKTOP">الاجهزة المكتبية</option>
                                <option {{ old('work_on') == 'MOBILE' ? 'selected' : '' }} value="MOBILE">الجوال</option>
                            </select>
                            @if ($errors->has('work_on'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('work_on') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">القناة</label>
                        <div class="col-9">
                            <select class="form-control" name="channel_id">
                                <option value="">اختر القناة</option>
                                @foreach($channels as $channel)
                                <option {{ old('channel_id') == $channel->id ? 'selected' : '' }} value="{{ $channel->id }}">{{ $channel->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('channel_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('channel_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">نوع السيرفر</label>
                        <div class="col-9">
                            <select class="form-control" name="server_type_id">
                                <option value="">اختر نوع السيرفر</option>
                                @foreach($serverTypes as $serverType)
                                <option {{ old('server_type_id') == $serverType->id ? 'selected' : '' }} value="{{ $serverType->id }}">{{ $serverType->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('server_type_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('server_type_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">اي دي السيرفر</label>
                        <div class="col-9">
                            <input class="form-control" name="code" value="{{ old('code') }}" placeholder="اي دي السيرفر" />
                            @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primry" value="أضافة" />
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <!--end::Portlet-->
	</div>


</div>

<script>
function selectUrlType(value)
{
    if(value == 'SECURE')
    {
        $("#code").replaceWith('<input class="form-control" id="code" name="code" value="{{ old("code") }}" placeholder="URL" />');
        $("#serverType").show();
        $("#url").show();
    }
    else if(value == 'URL')
    {
        $("#code").replaceWith('<input class="form-control" id="code" name="code" value="{{ old("code") }}" placeholder="URL" />');
        $("#serverType").hide();
        $("#url").show();
    }
    else if(value == 'CODE')
    {
        $("#code").replaceWith('<textarea class="form-control" id="code" name="code" placeholder="Code">{{ old("code") }}</textarea>');
        $("#serverType").hide();
        $("#url").show();
    }
}
</script>
@endsection
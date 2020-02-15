@extends('admin.layouts.app')
@section('title','السيرفرات')

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
            <form method="get" action="/admin/servers" style="width:100%;">
                <div class="row">
                <div class="col-md-3">
                        <select class="form-control" name="channelId">
                            <option value="">اخنر القناة</option>
                            @foreach($channels as $channel)
                            <option {{ isset($_GET['channelId']) && $_GET['channelId'] == $channel->id ? 'selected' : '' }} value="{{ $channel->id }}">{{ $channel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="serverTypeId">
                            <option value="">اخنر نوع السيرفر</option>
                            @foreach($serverTypes as $serverType)
                            <option {{ isset($_GET['serverTypeId']) && $_GET['serverTypeId'] == $serverType->id ? 'selected' : '' }} value="{{ $serverType->id }}">{{ $serverType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="quality">
                            <option value="">اخنر الجودة</option>
                            <option {{ isset($_GET['quality']) && $_GET['quality'] == 'MAIN' ? 'selected' : '' }} value="MAIN">بث رئيسي</option>
                            <option {{ isset($_GET['quality']) && $_GET['quality'] == 'HIGH' ? 'selected' : '' }} value="HIGH">عالية</option>
                            <option {{ isset($_GET['quality']) && $_GET['quality'] == 'MEDIUM' ? 'selected' : '' }} value="MEDIUM">متوسطة</option>
                            <option {{ isset($_GET['quality']) && $_GET['quality'] == 'LOW' ? 'selected' : '' }} value="LOW">منخفضة</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="status">
                            <option value="">الحالة</option>
                            <option {{ isset($_GET['status']) && $_GET['status'] == 'active' ? 'selected' : '' }} value="active">مفعل</option>
                            <option {{ isset($_GET['status']) && $_GET['status'] == 'inactive' ? 'selected' : '' }} value="inactive">غير مفعل</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success">تصفية</button>
                    </div>
                </div>
            </form>
        </div>
        
		<div class="m-portlet__head-tools">
            @if(auth()->user()->can('CREATE_SERVERS'))
            <a href="/admin/servers/create"><button class="btn btn-primry">أضافة</button></a>
            @endif
		</div>
    </div>

    <div class="m-portlet__body">
        <div class="tab-content">

            <!--begin::Widget 11--> 
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-striped m-table">
                    <!--begin::Thead-->
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>العنوان</td>
                            <td>يعمل علي</td>
                            <td>القناة</td>
                            <td>نوع السيرفر</td>
                            <td>الجودة</td>
                            <td>معاينة</td>
                            @if(auth()->user()->can('UPDATE_SERVERS'))
                            <td>مانع الاعلانات</td>
                            <td>مميز</td>
                            <td>الحالة</td>
                            <td>تعديل</td>
                            @endif
                            @if(auth()->user()->can('DELETE_SERVERS'))
                            <td>حذف</td>
                            @endif
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody>
                        @if(count($servers) > 0)
                            @foreach($servers as $server)
                            <tr>
                                <td>{{ $server->id }}</td>
                                <td>{{ $server->name }}</td>
                                <td>
                                    @if($server->work_on == 'ALL')
                                        الكل
                                    @elseif($server->work_on == 'DESKTOP')
                                        الاجهزة المكتبية
                                    @elseif($server->work_on == 'MOBILE')
                                        الجوال
                                    @endif
                                </td>
                                <td>{{ $server->channel->name }}</td>
                                <td>{{ $server->serverType->name }}</td>
                                <td>
                                    @if($server->quality == 'MAIN')
                                        البث الرئيسي
                                    @elseif($server->quality == 'HIGH')
                                        جودة عالية
                                    @elseif($server->quality == 'MEDIUM')
                                        جودة متوسطة
                                    @elseif($server->quality == 'LOW')
                                        جودة منخفضة
                                    @endif
                                </td>
                                <td><a href="/admin/servers/{{ $server->id }}" target="_blank">معاينة</a></td>
                                @if(auth()->user()->can('UPDATE_SERVERS'))
                                <td>
                                    <form action="/admin/servers/{{ $server->id }}/adblock" method="POST" style="display: inline;" onsubmit="if(confirm('AdBlock ? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm {{ $server->ads_block == 1 ? 'btn-primary' : 'btn-danger' }}">
                                            {{ $server->ads_block == 1 ? 'مفعل' : 'غير مفعل' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/admin/servers/{{ $server->id }}/featured" method="POST" style="display: inline;" onsubmit="if(confirm('Featured ? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm {{ $server->is_featured == 1 ? 'btn-primary' : 'btn-danger' }}">
                                            {{ $server->is_featured == 1 ? 'مميز' : 'غير مميز' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/admin/servers/{{ $server->id }}/status" method="POST" style="display: inline;" onsubmit="if(confirm('Active ? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm {{ $server->status == 1 ? 'btn-primary' : 'btn-danger' }}">
                                            {{ $server->status == 1 ? 'مفعل' : 'غير مفعل' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="/admin/servers/{{ $server->id }}/edit">
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="flaticon-edit"></i>
                                        </button>
                                    </a>
                                </td>
                                @endif
                                @if(auth()->user()->can('DELETE_SERVERS'))
                                <td>
                                    <form action="/admin/servers/{{ $server->id }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
                                <td colspan="12" style="text-align:center">لا توجد نتائج</td>
                            </tr>
                        @endif

                    </tbody>
                    <!--end::Tbody-->  

                </table>
                <!--end::Table-->                        
            </div>
            <div class="m-widget11__action m--align-right">
            {{ $servers->appends($_GET)->links() }}
            </div>
            <!--end::Widget 11-->

        </div>
    </div>

</div>
<!--end:: Widgets/Application Sales-->  
@endsection
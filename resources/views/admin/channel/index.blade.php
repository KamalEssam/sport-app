@extends('admin.layouts.app')
@section('title','القنوات')

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
            <form method="get" action="/admin/channels" style="width:100%;">
                <div class="row">

                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="بحث" />
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-success">تصفية</button>
                    </div>

                </div>
            </form>
        </div>
        
		<div class="m-portlet__head-tools">
            @if(auth()->user()->can('CREATE_CHANNELS'))
            <a href="/admin/channels/create"><button class="btn btn-primry">أضافة</button></a>
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
                            <td>الاسم</td>
                            <td>اسم الرابط</td>
                            <td>معاينة</td>
                            <td>نسخ</td>
                            @if(auth()->user()->can('UPDATE_CHANNELS'))
                            <td>تعديل</td>
                            @endif
                            @if(auth()->user()->can('DELETE_CHANNELS'))
                            <td>حذف</td>
                            @endif
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody>
                        @if(count($channels) > 0)
                            @foreach($channels as $channel)
                            <tr>
                                <td>{{ $channel->id }}</td>
                                <td>{{ $channel->name }}</td>
                                <td>{{ $channel->slug }}</td>
                                <td>
                                    <a href="/channels/{{ $channel->slug != '' ? $channel->slug : $channel->id }}" target="_blank">معاينة</a>
                                </td>
                                <td>
                                    <button data-id="{{ $channel->slug != '' ? $channel->slug : $channel->id }}" class="btn btn-sm btn-primary" onClick="copy(this)">نسخ</button>
                                </td>
                                @if(auth()->user()->can('UPDATE_CHANNELS'))
                                <td>
                                    <a href="/admin/channels/{{ $channel->id }}/edit">
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="flaticon-edit"></i>
                                        </button>
                                    </a>
                                </td>
                                @endif
                                @if(auth()->user()->can('DELETE_CHANNELS'))
                                <td>
                                    <form action="/admin/channels/{{ $channel->id }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
                                <td colspan="7" style="text-align:center">لا توجد نتائج</td>
                            </tr>
                        @endif

                    </tbody>
                    <!--end::Tbody-->  

                </table>
                <!--end::Table-->                        
            </div>
            <div class="m-widget11__action m--align-right">
            {{ $channels->appends($_GET)->links() }}
            </div>
            <!--end::Widget 11-->

        </div>
    </div>

<script>
function copy(value)
{
    var channelId= $(value).data('id');
    var protocol = location.protocol;
    var slashes  = protocol.concat("//");
    var host     = slashes.concat(window.location.hostname);
    var url      = host.concat("/channels/"+channelId);
    var code = '<iframe allowfullscreen="" scrolling="no" ';
        code += 'frameborder="0" height="800px" ';
        code += 'src="'+url+'" width="100%"></iframe>';
    var dummy = document.createElement("input");
    document.body.appendChild(dummy);
    dummy.value = code;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
}
</script>
</div>
<!--end:: Widgets/Application Sales-->  
@endsection
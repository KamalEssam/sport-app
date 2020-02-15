@extends('admin.layouts.app')
@section('title','انواع السيرفرات')

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
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<h3 class="m-portlet__head-text">انواع السيرفرات</h3>
			</div>
        </div>
        
		<div class="m-portlet__head-tools">
            @if(auth()->user()->can('CREATE_SERVER_TYPES'))
            <a href="/admin/servers-types/create"><button class="btn btn-primry">أضافة</button></a>
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
                            @if(auth()->user()->can('UPDATE_SERVER_TYPES'))
                            <td>تعديل</td>
                            @endif
                            @if(auth()->user()->can('DELETE_SERVER_TYPES'))
                            <td>حذف</td>
                            @endif
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody>
                        @if(count($serverTypes) > 0)
                            @foreach($serverTypes as $serverType)
                            <tr>
                                <td>{{ $serverType->id }}</td>
                                <td>{{ $serverType->name }}</td>
                                @if(auth()->user()->can('UPDATE_SERVER_TYPES'))
                                <td>
                                    <a href="/admin/servers-types/{{ $serverType->id }}/edit">
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="flaticon-edit"></i>
                                        </button>
                                    </a>
                                </td>
                                @endif
                                @if(auth()->user()->can('DELETE_SERVER_TYPES'))
                                <td>
                                    <form action="/admin/servers-types/{{ $serverType->id }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
                                <td colspan="4" style="text-align:center">لا توجد نتائج</td>
                            </tr>
                        @endif

                    </tbody>
                    <!--end::Tbody-->  

                </table>
                <!--end::Table-->                        
            </div>
            <div class="m-widget11__action m--align-right">
            {{ $serverTypes->appends($_GET)->links() }}
            </div>
            <!--end::Widget 11-->

        </div>
    </div>

</div>
<!--end:: Widgets/Application Sales-->  
@endsection
@extends('admin.layouts.app')
@section('title','البطولات')

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
        <div class="m-portlet__head-caption"  style="width:90%;">                
                <form method="get" action="/admin/leagues" style="width:100%;">
                    <div class="row">

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="بحث" />
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-success">تصفية</button>
                        </div>

                    </div>
                </form>
            </div>
            
            <div class="m-portlet__head-tools">
                @if(auth()->user()->can('CREATE_LEAGUES'))
                <a href="/admin/leagues/create"><button class="btn btn-primry">أضافة</button></a>
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
                                <td>الشعار</td>
                                <td>الاسم</td>
                                <td>الترتيب</td>
                                @if(auth()->user()->can('UPDATE_LEAGUES'))
                                <td>تعديل</td>
                                @endif
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody>
                            @if(count($leagues) > 0)
                                @foreach($leagues as $league)
                                <tr>
                                    <td>{{ $league->id }}</td>
                                    <td><img src="{{ $league->logo }}" style="border-radius:50%; width:35px; height:35px;" /></td>
                                    <td>{{ $league->name }}</td>
                                    <td>{{ $league->priority }}</td>
                                    @if(auth()->user()->can('UPDATE_LEAGUES'))
                                    <td>
                                        <a href="/admin/leagues/{{ $league->id }}/edit">
                                            <button type="submit" class="btn btn-sm btn-info">
                                                <i class="flaticon-edit"></i>
                                            </button>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" style="text-align:center">لا توجد نتائج</td>
                                </tr>
                            @endif

                        </tbody>
                        <!--end::Tbody-->  

                    </table>
                    <!--end::Table-->                        
                </div>
                <div class="m-widget11__action m--align-right">
                {{ $leagues->appends($_GET)->links() }}
                </div>
            </div>
            <!--end::Widget 11-->

        </div>
    </div>

</div>
<!--end:: Widgets/Application Sales-->  
@endsection

@section('scripts')
<script type="text/javascript">
function getCountries(continentId){
    $.ajax({
        type: "GET",
        url: "/continents/"+continentId+"/countries",
        data: "",
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
            var country_id = $("#country_id");
            country_id.empty();
            country_id.append($("<option />").val('').text('اختر الدولة'));
            $.each(data, function() {
                country_id.append($("<option />").val(this.country_id).text(this.name));
            });
        }
    });        
}
</script>
@endsection
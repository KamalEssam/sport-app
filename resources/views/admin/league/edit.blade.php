@extends('admin.layouts.app')
@section('title','تعديل بطولة')

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">تعديل بطولة</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/admin/leagues/{{ request()->route('league') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="form-group row">
                        <label class="col-3 col-form-label">الاسم</label>
                        <div class="col-9">
                            <input class="form-control" name="name" value="{{ $league->name }}" placeholder="الاسم" />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3 col-form-label">الأولاوية</label>
                        <div class="col-9">
                            <input type="number" class="form-control" name="priority" value="{{ $league->priority }}" placeholder="الأولاوية" />
                            @if ($errors->has('priority'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('priority') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">شعار البطولة</label>
                        <div class="col-9">
                            <input class="form-control" type="file" name="logo" />
                            @if ($errors->has('logo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('logo') }}</strong>
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
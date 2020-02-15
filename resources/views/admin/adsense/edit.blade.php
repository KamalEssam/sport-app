@extends('admin.layouts.app')
@section('title','تعديل الاعلانات')

@section('content')
<div class="row">

	<div class="col-md-12">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $message }}
        </div>
        @endif

		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">
            
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">تعديل الاعلانات</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/admin/adsenses" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT" />

                    <div class="form-group row">
                        <label class="col-3 col-form-label">حالة اعلان الفيديو</label>
                        <div class="col-9">
                            <select class="form-control" name="video_code_active">
                                <option value="true" {{ $adsense->video_code_active == "true" ? 'selected' : '' }}>فعال</option>
                                <option value="false" {{ $adsense->video_code_active == "false" ? 'selected' : '' }}>غير فعال</option>
                            </select>
                            @if ($errors->has('video_code_active'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('video_code_active') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">اعلان فيديو خاص بالاجهزة المكتبية</label>
                        <div class="col-9">
                            <textarea class="form-control" rows="6" name="video_code" placeholder="اعلان فيديو خاص بالاجهزة المكتبية">{{ $adsense->video_code }}</textarea>
                            @if ($errors->has('video_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('video_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">حالة اعلان منبثق خاص بالاجهزة المكتبية</label>
                        <div class="col-9">
                            <select class="form-control" name="desktop_code_active">
                                <option value="true" {{ $adsense->desktop_code_active == "true" ? 'selected' : '' }}>فعال</option>
                                <option value="false" {{ $adsense->desktop_code_active == "false" ? 'selected' : '' }}>غير فعال</option>
                            </select>
                            @if ($errors->has('desktop_code_active'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('desktop_code_active') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">اعلان منبثق خاص بالاجهزة المكتبية</label>
                        <div class="col-9">
                            <textarea class="form-control" rows="6" name="desktop_code" placeholder="اعلان منبثق خاص بالاجهزة المكتبية">{{ $adsense->desktop_code }}</textarea>
                            @if ($errors->has('desktop_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('desktop_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">حالة اعلان منبثق خاص بالموبايلات</label>
                        <div class="col-9">
                            <select class="form-control" name="mobile_code_active">
                                <option value="true" {{ $adsense->mobile_code_active == "true" ? 'selected' : '' }}>فعال</option>
                                <option value="false" {{ $adsense->mobile_code_active == "false" ? 'selected' : '' }}>غير فعال</option>
                            </select>
                            @if ($errors->has('mobile_code_active'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mobile_code_active') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">اعلان منبثق خاص بالموبايلات</label>
                        <div class="col-9">
                            <textarea class="form-control" rows="6" name="mobile_code" placeholder="اعلان منبثق خاص بالموبايلات">{{ $adsense->mobile_code }}</textarea>
                            @if ($errors->has('mobile_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mobile_code') }}</strong>
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
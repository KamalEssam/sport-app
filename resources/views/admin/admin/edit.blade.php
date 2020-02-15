@extends('admin.layouts.app')
@section('title','تعديل مستخدم')

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">تعديل مستخدم</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/admin/admins/{{ request()->route('admin') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">الاسم</label>
                        <div class="col-9">
                            <input class="form-control" name="name" value="{{ $user->name }}" placeholder="الاسم" />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">البريد الإلكتروني</label>
                        <div class="col-9">
                            <input class="form-control" name="email" value="{{ $user->email }}" placeholder="البريد الإلكتروني" />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">كلمة المرور</label>
                        <div class="col-9">
                            <input class="form-control" name="password" placeholder="كلمة المرور" />
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">تأكيد كلمة المرور</label>
                        <div class="col-9">
                            <input class="form-control" name="password_confirmation" placeholder="تأكيد كلمة المرور" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3 col-form-label">الصلاحيات</label>
                        <div class="col-9">
                            <table class="table table-striped m-table">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>أضافة</td>
                                        <td>قراءة</td>
                                        <td>تعديل</td>
                                        <td>حذف</td>
                                    </tr>
                                </thead>
                                    <tr>
                                        <td>المباريات</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_MATCHES" {{ in_array('CREATE_MATCHES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_MATCHES" {{ in_array('READ_MATCHES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_MATCHES" {{ in_array('UPDATE_MATCHES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_MATCHES" {{ in_array('DELETE_MATCHES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>البطولات</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_LEAGUES" {{ in_array('CREATE_LEAGUES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_LEAGUES" {{ in_array('READ_LEAGUES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_LEAGUES" {{ in_array('UPDATE_LEAGUES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>القنوات</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_CHANNELS" {{ in_array('CREATE_CHANNELS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_CHANNELS" {{ in_array('READ_CHANNELS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_CHANNELS" {{ in_array('UPDATE_CHANNELS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_CHANNELS" {{ in_array('DELETE_CHANNELS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>السيرفرات</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_SERVERS" {{ in_array('CREATE_SERVERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_SERVERS" {{ in_array('READ_SERVERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_SERVERS" {{ in_array('UPDATE_SERVERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_SERVERS" {{ in_array('DELETE_SERVERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr> 

                                    <tr>
                                        <td>انواع السيرفرات</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_SERVER_TYPES" {{ in_array('CREATE_SERVER_TYPES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_SERVER_TYPES" {{ in_array('READ_SERVER_TYPES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_SERVER_TYPES" {{ in_array('UPDATE_SERVER_TYPES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_SERVER_TYPES" {{ in_array('DELETE_SERVER_TYPES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>      

                                    <tr>
                                        <td>المديرين</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_ADMINS" {{ in_array('CREATE_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_ADMINS" {{ in_array('READ_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_ADMINS" {{ in_array('UPDATE_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_ADMINS" {{ in_array('DELETE_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>الاعلانات</td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_ADSENSES" {{ in_array('UPDATE_ADSENSES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                        </td>
                                    </tr>

                                <tbody>
                                </tbody>
                            </table>
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
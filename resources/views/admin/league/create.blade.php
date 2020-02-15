@extends('admin.layouts.app')
@section('title','أضافة بطولة')

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">أضافة بطولة</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/admin/leagues" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">البطولة</label>
                        <div class="col-9">
                            <select class="form-control" name="league">
                                <option value="">اختر البطولة</option>
                                @foreach($leagues as $league)
                                    @if(!in_array($league->id, $myLeaguesIds))
                                    <option value="{{ json_encode($league) }}">{{ $league->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('league'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('league') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3 col-form-label">الأولاوية</label>
                        <div class="col-9">
                            <input type="number" class="form-control" name="priority" value="{{ old('priority') }}" placeholder="الأولاوية" />
                            @if ($errors->has('priority'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('priority') }}</strong>
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
@endsection
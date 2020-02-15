@extends('admin.layouts.auth')
@section('title','تسجيل الدخول')

@section('content')
<div class="m-login__signin">
    
    <div class="m-login__head">
        <h3 class="m-login__title">لوحة التحكم</h3>
    </div>

    <form class="m-login__form m-form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} m-form__group">
            <input class="form-control m-input" type="text" placeholder="البريد الإلكتروني" name="email" value="{{ old('email') }}" autocomplete="off" required autofocus="">

            @if ($errors->has('email'))
                <div id="email-error" class="form-control-feedback">{{ $errors->first('email') }}</div>
            @endif

        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }} m-form__group">
            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="كملة المرور" name="password" required>

            @if ($errors->has('password'))
                <div id="password-error" class="form-control-feedback">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div class="row m-login__form-sub">
            <div class="col m--align-left">
                <label class="m-checkbox m-checkbox--focus">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> تذكرني
                    <span></span>
                </label>
            </div>
            <div class="col m--align-right">
            </div>
        </div>
        <div class="m-login__form-action">
            <button type="submit" class="btn btn-brand">
                دخول
            </button>
        </div>
    </form>

</div>
@endsection

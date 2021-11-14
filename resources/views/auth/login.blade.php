@extends('auth.app')

@section('content')
    <div class="login-box">
        <div class="white-box">
            <form class="form-horizontal form-material" id="loginform" action="{{ route('login') }}"
                  method="post">
                @csrf
                <h3 class="text-center box-title m-b-20">
                    @if ($errors->has('phone') || $errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: #761b18 !important;">{{ trans('validation.message') }}</strong>
                        </span>
                    @else
                        ورود
                    @endif
                </h3>
                <div class="form-group ">
                    <div class="col-12">
                        <input class="form-control" type="text" name="phone" required="" placeholder="شماره همراه">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                        <input class="form-control" type="password" name="password" required="" placeholder="رمز عبور">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-right p-t-0">
                            <input id="checkbox-signup" type="checkbox" name="remember">
                            <label for="checkbox-signup"> به خاطر سپاری </label>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                type="submit">ورود
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

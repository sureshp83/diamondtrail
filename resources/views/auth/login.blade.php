@extends('layouts.app')
@section('title','Login')
@section('content')
    <div class="page-content">
    <h1 class="main-title">Login</h1>
    <div class="container">
        <div id="login">
        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible" style="width:40%;margin:10px auto;text-align:center;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php $error= $errors->all();
                    echo $error[0];
                ?>
            </div>
        @endif
            <form method="post" action="{{route('login')}}" autocomplete="off">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-xs-12 offset-lg-4 offset-md-3">
                        <div class="login-box">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label for="username" class="control-label">Username</label>
                                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="control-label">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <a class="forgot-password-text text-sm-right" href="{{ route('password.request') }}">Forgot Password? </a>
                                    <button type="submit" class="btn btn-primary btn-full">Log in</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
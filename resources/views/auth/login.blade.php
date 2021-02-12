@extends('layouts.login')

@section('content')

    <h2>SIGN IN</h2>
    <form action="{{route('login.auth')}}" method='POST' class='form-validate' id="test">
        @csrf
        <div class="control-group">
            <div class="email controls">
                <input type="text" name='email' value="" placeholder="Email address" class='input-block-level' data-rule-required="true" data-rule-email="true">
            </div>
        </div>
        <div class="control-group">
            <div class="pw controls">
                <input type="password" name="password" value="" placeholder="Password" class='input-block-level' data-rule-required="true">
            </div>
        </div>
        <div class="submit">
            <div class="remember">
                <input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember"> <label for="remember">Remember me</label>
            </div>
            <input type="submit" value="Sign me in" class='btn btn-primary'>
        </div>
    </form>
    <div class="forget">
        <a href="#"><span>Forgot password?</span></a>
    </div>

@endsection

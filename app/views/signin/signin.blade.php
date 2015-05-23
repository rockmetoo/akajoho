@extends('layouts.signinHeader')

@section('internalJSLibrary')
    @if (App::environment('production'))
    	{{ HTML::script('/js/jquery-1.11.0.js', [], true) }}
    @else
    	{{ HTML::script('/js/jquery-1.11.0.js') }}
    @endif
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <h3 class="panel-title">Signin</h3>
                        </div>
                        <div class="pull-right">
                            <span style="font-size: 11px;">
                                <a href="/signup" target="_self">Don't have any account?</a>
                            </span>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if ($errors->has('email') || Session::get('loginFailure'))
                            <ul class="list_of_error" id="list_of_error_email">
                                <li id="error_item_email_default">Please enter your email address and password correctly</li>
                            </ul>
                        @endif
                        <form role="form" action="/signin" name="signinForm" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{ Input::old('email') }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <label class="label-checkbox inline">
                                        <input name="remember" type="checkbox" value="1" class="regular-checkbox chk-delete" />
                                    </label>
                                    Remember me
                                </div>
                                <div class="form-group">
                                    <a href="/forgot/password" target="_self">Forgot your password?</a>
                                </div>
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block">Sign in</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 padding-md">
                        <a href="/about" style="color:white"><small>About Us</small></a>
                        <a href="/privacy" style="color:white"><small>Privacy Policy</small></a>
                        <a href="/terms" style="color:white"><small>Terms & Conditions</small></a>
                        <a href="/sitemap" style="color:white"><small>Site Map</small></a>
                        <a href="https://www.facebook.com/akajoho" data-toggle="tooltip" data-original-title="facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                    	<a href="/subscribe" class="btn" data-toggle="tooltip" data-original-title="email us" style="color:white"><i class="fa fa-envelope fa-fw">&nbsp;Subscribe</i></a>
                </div>
            </div>
        </div>
    </footer>
@stop
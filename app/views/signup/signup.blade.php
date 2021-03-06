@extends('layouts.signupHeader')

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
                            <h3 class="panel-title">Sign up</h3>
                        </div>
                        <div class="pull-right">
                            <span style="font-size: 11px;">
                                <a href="/signin" target="_self">Already have an account?</a>
                            </span>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (null !== Session::get('error'))
                            <ul class="list_of_error" id="list_of_error_email">
                                <li id="error_item_email_default">
                                    {{ Session::get('error') }}
                                </li>
                            </ul>
                        @endif
                        <form role="form" action="/signup" name="signupForm" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{ Input::old('email') }}" autofocus />
                                    @if ($errors->has('email'))
                                        <ul class="list_of_error" id="list_of_error_email">
                                            <li id="error_item_email_default">
                                                Please enter a valid email address
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter a password of 6 or more characters" name="password" type="password" value="" />
                                    @if ($errors->has('password'))
                                        <ul class="list_of_error" id="list_of_error_repassword">
                                            <li id="error_item_repassword_default">
                                                Please enter a password of 6 or more characters
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm password" name="repassword" type="password" value="" />
                                    @if ($errors->has('repassword'))
                                        <ul class="list_of_error" id="list_of_error_repassword">
                                            <li id="error_item_repassword_default">
                                                Password does not match
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="label-checkbox inline">
                                        <input name="agree" type="checkbox" value="1" class="regular-checkbox chk-delete" />
                                    </label>
                                    I accept to the <a href="/terms" target="_blank">Terms of Service</a>
                                </div>
                                @if ($errors->has('agree'))
                                    <ul class="list_of_error" id="list_of_error_agree">
                                        <li id="error_item_agree_default">
                                            In order to use Schooler, you must agree to the Terms of Service.
                                        </li>
                                    </ul>
                                @endif
                                <div class="seperator"></div>
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block">Sign up</button>
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
@extends('layouts.signinHeader')

@section('internalJSLibrary')
    @if (App::environment('production'))
    	{{ HTML::script('/js/jquery-1.11.0.js', [], true) }}
    @else
    	{{ HTML::script('/js/jquery-1.11.0.js') }}
    @endif
@stop

@section('content')
    <div class="container-fluid page-content-top">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel-body">
                    <div class="alert alert-success" style="margin-top: 5%">
                        Please check your email<br/>
                        We've sent you an email that will help you to finish your signup process.
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
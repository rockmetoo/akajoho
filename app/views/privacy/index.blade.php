@extends('layouts.indexHeader')

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
            <div class="col-md-12">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <h3 class="panel-title">Privacy</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                    	Comming Soon
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
                    <p class="font-lg text-danger">Information</p>
                    <ul class="list-unstyled useful-link">
                        <li><a href="/about"><small>About Us</small></a></li>
                        <li><a href="/privacy"><small>Privacy Policy</small></a></li>
                        <li><a href="/terms"><small>Terms & Conditions</small></a></li>
                        <li><a href="/sitemap"><small>Site Map</small></a></li>
                    </ul>
                </div>
                <div class="col-sm-3 padding-md">
                    <p class="font-lg text-danger">Stay Connect</p>
                    <a href="https://www.facebook.com/akajoho" data-toggle="tooltip" data-original-title="facebook" style="cursor:pointer" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="/subscribe" class="btn" data-toggle="tooltip" data-original-title="email us"  style="cursor:pointer"><i class="fa fa-envelope fa-fw">&nbsp;Subscribe</i></a>
                </div>
            </div>
        </div>
    </footer>
@stop

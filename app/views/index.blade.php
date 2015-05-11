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

					<div class="row" style="margin-top:2%">
						<div class="col-lg-12">
							<h3 class="item-header">Hot Items</h1>
						</div>
					</div>

                    <div class="row">
		            	<div class="col-lg-3 col-md-6">
		                    <div class="panel panel-primary">
		                        <div class="panel-heading">
		                            <div class="row">
		                                <div class="col-xs-3">
		                                    <i class="fa fa-comments fa-5x"></i>
		                                </div>
		                                <div class="col-xs-9 text-right">
		                                    <div class="huge">26</div>
		                                    <div>New Comments!</div>
		                                </div>
		                            </div>
		                        </div>
		                        <a href="#">
		                            <div class="panel-footer">
		                                <span class="pull-left">View Details</span>
		                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		                                <div class="clearfix"></div>
		                            </div>
		                        </a>
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
                    </ul>
                </div>
                <div class="col-sm-3 padding-md">
                    <p class="font-lg text-danger">Useful Links</p>
                    <ul class="list-unstyled useful-link">
                        <li><a href="/sitemap"><small>Site Map</small></a></li>
                        <li><a href="/affiliates"><small>Affiliates</small></a></li>
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
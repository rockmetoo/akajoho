@extends('layouts.indexHeader')

@section('content')
    <div id="landing-content">
        <div class="bg-white">
            <div id="contact" class="text-center content-padding">
                <div class="container">
                    <div class="row" style="margin-top: 5%;">
	                    <form name="searchForm" class="form-inline content-padding" method="post" action="/search">
							<div class="form-group input-group col-lg-4">
								<input name="search" class="form-control" type="text" placeholder="">
							</div>
	                        <button class="btn btn-info" type="submit" name="submit">Search</button>
	                    </form>
	                </div>
                    <br/>
					<div class="row">
						<div class="col-lg-12">
							<h3 class="item-header">Recent Items</h1>
						</div>
					</div>
                    @for ($i = 0; $i < 4; $i++)
                    <div class="row">
                    	@for ($j = 0; $j < 4; $j++)
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
						@endfor
					</div>
					@endfor
					<div class="row">
						<div class="col-lg-12">
							<h3 class="item-header">Hot Items</h1>
						</div>
					</div>
                    @for ($i = 0; $i < 4; $i++)
                    <div class="row">
                    	@for ($j = 0; $j < 4; $j++)
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
						@endfor
					</div>
					@endfor
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 padding-md">
                    <p class="font-lg text-danger">Information</p>
                    <ul class="list-unstyled useful-link">
                        <li><a href="/about"><small>About Us</small></a></li>
                        <li><a href="/delivery/information"><small>Delivery Information</small></a></li>
                        <li><a href="/privacy"><small>Privacy Policy</small></a></li>
                        <li><a href="/terms"><small>Terms & Conditions</small></a></li>
                    </ul>
                </div>
                <div class="col-sm-3 padding-md">
                    <p class="font-lg text-danger">Useful Links</p>
                    <ul class="list-unstyled useful-link">
                        <li><a href="/contact"><small>Contact Us</small></a></li>
                        <li><a href="/sitemap"><small>Site Map</small></a></li>
                        <li><a href="/affiliates"><small>Affiliates</small></a></li>
                    </ul>
                </div>
                <div class="col-sm-3 padding-md">
                    <p class="font-lg text-danger">Stay Connect</p>
                    <a href="#" class="social-connect tooltip-test facebook-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="#" class="social-connect tooltip-test twitter-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                </div>
                <div class="col-sm-3 padding-md">
                    <p class="font-lg text-danger">Contact Us</p>
                    Email : {{Config::get('akazoho.mail.contact')}}
                    <div class="seperator"></div>
                    <a class="btn btn-info">
                        <i class="fa fa-envelope"></i>
                        Contact support
                    </a>
                </div>
            </div>
        </div>
    </footer>
@stop
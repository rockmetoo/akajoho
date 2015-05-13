@extends('layouts.indexHeader')

@section('internalJSLibrary')
    @if (App::environment('production'))
    	{{ HTML::script('/js/jquery-1.11.0.js', [], true) }}
    @else
    	{{ HTML::script('/js/jquery-1.11.0.js') }}
    @endif
@stop

@section('content')
    <div class="container-fluid index-page-intro">
		<div class="col-md-6 col-md-offset-3 index-search-box">
			<div class="row text-center">
				<form role="form" action="/search" name="searchForm" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col-lg-8">
						<input type="text" value="" placeholder="City/Postcode/Toys..." class="form-control" name="search" autocomplete="off" autofocus>
					</div>
	
					<div class="col-lg-2">
						<button class="btn btn-primary btn-block"><i class="icon-search"></i><strong>Search</strong></button>
					</div>
				</form>
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
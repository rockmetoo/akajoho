<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Akajoho - Signin</title>
        
        @yield('internalCSSLibrary')

        @yield('internalJSLibrary')
        @yield('internalJSCode')
        
        @if (App::environment('production'))
            @include('layouts.productionHeader')
        @else
            @include('layouts.header')
        @endif
    </head>
    <body>
        <div id="wrapper">
        	<nav class="navbar navbar-default navbar-fixed-top bg-white" role="navigation" style="margin-bottom: 0;border-bottom: 1px solid #cccccc">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="/" class="navbar-brand">
                            <span class="header-title-text">Akajoho</span>
                        </a>
                    </div>
					
					<div class="navbar-default sidebar" role="navigation">
						<div class="sidebar-nav navbar-collapse collapse">
	                        <ul class="nav" id="side-menu">
	                            <li>
	                                <a href="/signup" class="top-link">Signup</a>
	                            </li>
	                            <li>
	                                <a href="/subscribe" class="top-link">Subscribe</a>
	                            </li>
	                        </ul>
						</div>
                    </div>
                </div>
            </nav>
            @yield('content')
            @yield('footer')
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Akajoho - enjoy with your akachan</title>

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
            <nav class="navbar navbar-default navbar-fixed-top bg-white" role="navigation" style="margin-bottom: 0">
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </button>
	                    <a href="/" class="navbar-brand">
	                        <span class="header-title-text">Akajoho</span>
	                    </a>
	                </div>
	                
	                <ul class="nav navbar-top-links navbar-right">
	                    <li>
	                        <a class="dropdown-toggle" href="/profile">{{ Auth::user()->email }}</a>
	                    </li>
	                    <li>
	                        <a class="dropdown-toggle" href="/signout">Signout</a>
	                    </li>
	                </ul>

	                <div class="navbar-default sidebar" role="navigation">
	                    <div class="sidebar-nav navbar-collapse collapse">
	                        <ul class="nav" id="side-menu">
	                            @yield('leftSideMenu')
	                        </ul>
	                    </div>
	                </div>
            </nav>
            @yield('content')
        </div>
    </body>
</html>

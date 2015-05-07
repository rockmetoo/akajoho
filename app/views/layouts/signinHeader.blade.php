<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Akazoho - Signin</title>
        @if (App::environment('production'))
            @include('layouts.productionHeader')
        @else
            @include('layouts.header')
        @endif
    </head>
    <body>
        <div id="wrapper">
            <header class="navbar navbar-fixed-top bg-white" style="border-bottom: 1px solid #cccccc">
                <div class="container">
                    <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="/" class="navbar-brand">
                            <span class="header-title-text">Akazoho</span>
                        </a>
                    </div>
                    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="/subscribe" class="top-link">Subscribe</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>
            @yield('content')
            @yield('footer')
        </div>
    </body>
</html>

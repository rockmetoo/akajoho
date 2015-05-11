@extends('layouts.subscribeHeader')

@section('internalJSLibrary')
    @if (App::environment('production'))
    	{{ HTML::script('/js/jquery-1.11.0.js', [], true) }}
    @else
    	{{ HTML::script('/js/jquery-1.11.0.js') }}
    @endif
@stop

@section('internalJSCode')
    <script type="text/javascript">
    jQuery(function($) {
    	setTimeout(function () {
			$('.alert-success').hide('slow');
        }, 5000);
    });
    </script>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <h3 class="panel-title">Email Subscribe</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (null !== Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <form role="form" action="/subscribe" name="subscribeForm" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <a href="http://www.akajoho.com/">Get latest news and post from www.akajoho.com</a>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{ Input::old('email') }}" autofocus>
			                        @if ($errors->has('email'))
			                            <ul class="list_of_error" id="list_of_error_email">
			                                <li id="error_item_email_default">Please enter your email address properly!</li>
			                            </ul>
			                        @endif
                                </div>
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block">Subscribe</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
@stop
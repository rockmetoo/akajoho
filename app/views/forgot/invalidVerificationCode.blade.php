@extends('layouts.signinHeader')

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
            <div class="col-lg-12">
                <div class="panel-body">
                    <div class="alert alert-danger">
                        Invalid link. If you would like to reset password please click <a href="/forgot/password" target="_self">here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
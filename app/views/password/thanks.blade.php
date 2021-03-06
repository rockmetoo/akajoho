@extends('layouts.akachanHeader')

@include('layouts.leftsidemenu')

@include('layouts.leftSideUserBlock')

@section('internalJSLibrary')
    @if (App::environment('production'))
    	{{ HTML::script('/js/jquery-1.11.0.js', [], true) }}
    @else
    	{{ HTML::script('/js/jquery-1.11.0.js') }}
    @endif
@stop

@section('internalJSCode')
@stop

@section('content')
    <div id="page-wrapper">
        <br/>
        <div class="row rowContainer">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Change password</div>
                    <div class="panel-body">
                        <div class="alert alert-success">
                            Password has been updated successfully
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
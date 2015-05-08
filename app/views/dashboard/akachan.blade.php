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
            <div class="col-lg-8">
                <a href="/lesson">Create Lesson</a> | <a href="/question">Create Question</a>
            </div>
        </div>
    </div>
@stop


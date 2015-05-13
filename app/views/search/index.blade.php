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
        <div class="row">
            <div class="col-md-12">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <h3 class="panel-title">Search Result (<small>comming soon</small>)</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                    	We are currently working on this. Search result will come up with various different results based on your keyword.
                    	Some results can be:<br/> <i>kids store, playing facility, hospital, family restaurant and kids products.</i><br/><br/>
                    	
                    	Feedback us: <a href="mailto:akajoho@gmail.com?Subject=recommendation%20for%20akajoho" target="_top">akajoho@gmail.com</a>
                    </div>
            </div>
        </div>
    </div>
@stop


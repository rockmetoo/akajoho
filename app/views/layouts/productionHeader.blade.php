<!-- Bootstrap Core CSS -->
{{ HTML::style('/css/bootstrap.min.css', [], true); }}
<!-- Timeline CSS -->
{{ HTML::style('/css/plugins/timeline.css', [], true); }}
<!-- Custom CSS -->
{{ HTML::style('/css/sbadmin.css', [], true); }}
<!-- Custom Fons -->
{{ HTML::style('/css/font-awesome.min.css', [], true); }}

@if (Agent::isMobile() || Agent::isTablet())
	{{ HTML::style('/css/plugins/metisMenu/metisMenu.min.css', [], true); }}
	
	{{ HTML::script('/js/bootstrap.min.js', [], true) }}
	{{ HTML::script('/js/metisMenu.min.js', [], true) }}
	{{ HTML::script('/js/sbadmin.js', [], true) }}
@endif
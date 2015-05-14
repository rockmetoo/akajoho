@extends('layouts.indexHeader')

@section('internalJSLibrary')
    @if (App::environment('production'))
    	{{ HTML::script('/js/jquery-1.11.0.js', [], true) }}
    @else
    	{{ HTML::script('/js/jquery-1.11.0.js') }}
    @endif
@stop

@section('content')
    <div class="container-fluid page-content-top">
        <div class="row">
            <div class="col-lg-12">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						<h3>Privacy Policy</h3>
					</div>
				</div>
				<div class="panel-body">
					<p>This privacy policy is for <a href="http://www.akajoho.com">www.akajoho.com</a> which governs the privacy of its users who choose to use it. The policy sets out the different areas where user privacy is concerned and outlines the obligations & requirements of the users, <a href="http://www.akajoho.com">akajoho.com</a> and <a href="http://www.akajoho.com">akajoho.com</a> owners. Furthermore the way <a href="http://www.akajoho.com">akajoho.com</a> processes, stores and protects user data and information will also be detailed within this policy.</p>
				</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <h3>This Application</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<a href="http://www.akajoho.com">akajoho.com</a> and its owners take a proactive approach to user privacy and ensure the necessary steps are taken to protect the privacy of its users throughout their visiting experience. <a href="http://www.akajoho.com">akajoho.com</a> complies to all international laws and requirements for user privacy.
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <h3>Cookies</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<a href="http://www.akajoho.com">akajoho.com</a> uses cookies to better the users experience while visiting <a href="http://www.akajoho.com">akajoho.com</a>. Where applicable, <a href="http://www.akajoho.com">akajoho.com</a> uses a cookie control system allowing the user on their first visit to <a href="http://www.akajoho.com">akajoho.com</a> to allow or disallow the use of cookies on their computer / device.<br/>This complies with recent legislation requirements for websites to obtain explicit consent from users before leaving behind or reading files such as cookies on a user's computer / device. Cookies are small files saved to the user's computers hard drive that track, save and store information about the user's interactions and usage of <a href="http://www.akajoho.com">akajoho.com</a>. This allows <a href="http://www.akajoho.com">akajoho.com</a>, through its server to provide the users with a tailored experience within <a href="http://www.akajoho.com">akajoho.com</a>.
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <h3>Contact & Communication</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                    	Users contacting <a href="http://www.akajoho.com">akajoho.com</a> and/or its owners do so at their own discretion and provide any such personal details requested at their own risk. Your personal information is kept private and stored securely until a time it is no longer required or has no use, as detailed in the Data Protection Act. Every effort has been made to ensure a safe and secure form to email submission process but advise users using such form to email processes that they do so at their own risk.<br/>
                    	<a href="http://www.akajoho.com">akajoho.com</a> and its owners use any information submitted to provide you with further information about the products / services they offer or to assist you in answering any questions or queries you may have submitted. This includes using your details to subscribe you to any email newsletter program <a href="http://www.akajoho.com">akajoho.com</a> operates but only if this was made clear to you and your express permission was granted when submitting any form to email process. Or whereby you the consumer have previously purchased from or enquired about purchasing from the company a product or service that the email newsletter relates to. This is by no means an entire list of your user rights in regard to receiving email marketing material. Your details are not passed on to any third parties.
                    </div>
            </div>
        <div class="row">
            <div class="col-md-12">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <h3>Email Newsletter</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<a href="http://www.akajoho.com">akajoho.com</a> operates an email newsletter program, used to inform subscribers about products and services supplied by <a href="http://www.akajoho.com">akajoho.com</a>. Users can subscribe through an online automated process should they wish to do so but do so at their own discretion. Some subscriptions may be manually processed through prior written agreement with the user.<br/>
                    	Subscriptions are taken in compliance with Spam Laws detailed in the Privacy and Electronic Communications Regulations. All personal details relating to subscriptions are held securely and in accordance with the Data Protection Act. No personal details are passed on to third parties nor shared with companies / people outside of the company that operates <a href="http://www.akajoho.com">akajoho.com</a>.
                    </div>
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

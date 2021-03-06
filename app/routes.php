<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'IndexController@getIndex');

// XXX: IMPORTANT - for server health monitoring daemon
Route::get('/status', function() {
    return Response::json('ok', 200);
});

// route to process search form
Route::get('/search', 'IndexController@getIndex');
Route::post('/search', 'SearchController@postSearch');
	
// route to show the signin form
Route::get('/signin', 'AlohaController@getSignin');

// route to process the signin form
Route::post('/signin', 'AlohaController@postSignin');

Route::get('/signout', 'AlohaController@getSignout');

// signup routing
Route::get('/signup', 'AlohaController@getSignup');
Route::post('/signup', 'AlohaController@postSignup');
Route::get('/signup/verify', 'AlohaController@getSignupVerify');

// Forgot password routing
Route::get('/forgot/password', 'ForgotPasswordController@getForgotPassword');
Route::post('/forgot/password', 'ForgotPasswordController@postForgotPassword');
Route::get('/forgot/password/verify', 'ForgotPasswordController@getVerify');
Route::post('/forgot/password/verify', 'ForgotPasswordController@postVerify');

// Subsribe by email
Route::get('/subscribe', 'EmailSubscribeController@getEmailSubscribe');
Route::post('/subscribe', 'EmailSubscribeController@postEmailSubscribe');

Route::get('/about', 'AboutController@getAbout');

Route::get('/privacy', 'PrivacyController@getPrivacy');

Route::get('/terms', 'TermsController@getTerms');

Route::get('/sitemap', 'SitemapController@getSitemap');
Route::get('/sitemap.xml', 'SitemapController@getSitemap');

// XXX: IMPORTANT - pages which require authentication
Route::group(array('before' => 'auth'), function()
{
    Route::get('/dashboard', 'DashBoardController@getDashBoard');
    
    Route::get('/profile', 'ProfileController@getProfile');
    Route::post('/profile', 'ProfileController@postProfile');
    Route::post('/profile/picture/upload', 'ProfileController@postTemporaryProfilePicture');
    
    Route::get('/change/password', 'PasswordController@getPassword');
    Route::post('/change/password', 'PasswordController@postPassword');
    
    // XXX: IMPORTANT - profile picture1 routing
    Route::get('/pf/p0', 'PictureController@getProfilePic0');
    Route::get('/pf/p1', 'PictureController@getProfilePic1');
    Route::get('/pf/p2', 'PictureController@getProfilePic2');
    Route::get('/pf/tp1/{rand}', 'PictureController@getProfileTmpPic')
    ->where('rand', '[0-9]+');
    
    Route::get('/feeding/draining', 'FeedingAndDrainingController@getFeedingAndDraining');
    Route::post('/feeding/draining', 'FeedingAndDrainingController@postFeedingAndDraining');
    
    Route::get('/weight/heat', 'WeightAndHeatController@getWeightAndHeat');
    Route::post('/weight/heat', 'WeightAndHeatController@postWeightAndHeat');
    
    Route::get('/mycalendar', 'MycalendarController@getIndex');
    Route::get('/mycalendar/events', 'MycalendarController@getEvents');
    
    Route::get('/mycalendar/add/event/{timestamp}', 'MycalendarController@getAddEvent')
    ->where('timestamp', '[0-9]+');
    
    Route::post('/mycalendar/add/event/{timestamp}', 'MycalendarController@postAddEvent')
    ->where('timestamp', '[0-9]+');
    
    Route::get('/mycalendar/update/event/{id}', 'MycalendarController@getUpdateEvent')
    ->where('id', '[0-9]+');
    
    Route::post('/mycalendar/update/event/{id}', 'MycalendarController@postUpdateEvent')
    ->where('id', '[0-9]+');
    
    Route::get('/get/fb/token', 'SNSAuthController@getFacebookToken');
    Route::get('/get/tw/token', 'SNSAuthController@getTwitterToken');
    
    Route::get('/fb/token/callback', 'SNSAuthController@getFacebookAuth');
    Route::get('/tw/token/callback', 'SNSAuthController@getTwitterAuth');
});
<?php

class SitemapController extends BaseController
{
    public function getSitemap()
    {
    	$sitemap = App::make("sitemap");
    	
    	// Add static pages like this:
    	$sitemap->add(URL::to('/'), '2015-05-12T12:30:00+02:00', '1.0', 'daily');
    	$sitemap->add(URL::to('about'), '2015-05-12T12:30:00+02:00', '0.7', 'monthly');
    	$sitemap->add(URL::to('signin'), '2015-05-12T12:30:00+02:00', '0.8', 'weekly');
    	$sitemap->add(URL::to('signup'), '2015-05-12T12:30:00+02:00', '0.8', 'weekly');
    	$sitemap->add(URL::to('subscribe'), '2015-05-12T12:30:00+02:00', '0.7', 'monthly');
    	
    	// XXX: IMPORTANT - Add dynamic pages if require
    	/*$tricks = Trick::all();
    	
    	foreach($tricks as $trick) {
    		$sitemap->add(URL::to("tricks/{$trick->slug}"), $trick->created_at, '0.9', 'weekly');
    	}
    	
    	foreach($categories as $category) {
    		$sitemap->add(URL::to("categories/{$category->slug}"), $category->created_at, '0.9', 'weekly');
    	}*/
    	
    	// Now, output the sitemap:
    	return $sitemap->render('xml');
    }
}

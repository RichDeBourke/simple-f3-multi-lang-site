<?php

// Base controller
class UtilitiesController {

    // For request for the root directory – reroute to a language subdirectory
	function getLanguage($f3) {
        $f3->reroute('@'.\Preflang::instance()->langDirectory($f3).'_home');
    }

    // Redirect requests for index.htm, index.html, and index.php to the root directory.
    function indexOverride($f3) {
        $f3->reroute('/');
    }

    // Redirect invalid URL requests due to a missing or additional slash
    function invalidURL($f3) {
        if (preg_match('/.+\/$/',$f3->get('PATH'))) {
            $f3->reroute(substr($f3->get('PATH'),0,-1));
        } else {
            $f3->reroute($f3->get('PATH').'/');
        }
    }
        
    // Generates an error (for testing the error page)
    function errorTest($f3) {
        user_error('Error',E_USER_ERROR);
    }


    function getSitemap($f3) {
        $f3->set('fdate',
            function($fileName) {
                if (file_exists('app/ui/'.$fileName.'.html')) {
                    return date ('Y-m-d', filemtime('app/ui/'.$fileName.'.html'));
                 } else {
                     return 'Error';
                 }
            }
        );

        $aliases = ($f3->get('ALIASES'));
        $sitemapAliases = [];

        // route names ending with x are left off the sitemap
        foreach ($aliases as $routeName => $path) {
            if (substr($routeName,-1) !== 'x') {
                $sitemapAliases[$routeName] = $path;
            }
        }

        $f3->set('sitemapAliases',$sitemapAliases);

		echo \Template::instance()->render('sitemap.xml','text/xml');
    }


	// Instantiate class
	function __construct() {
		$f3=\Base::instance();
    }
    
}

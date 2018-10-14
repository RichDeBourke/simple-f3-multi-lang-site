<?php

// Base controller
class Controller {

    // protected - I'm not using this yet, but leave in so I can use later
    //	$db;
    
	// HTTP route pre-processor
	function beforeroute($f3) {
        $f3->set('googleNoIndex',false); // Set to true when needed
        $f3->set('isHomePage',false); // Set to true for home pages
        $f3->set('isDetailPage',false); // Set to true for detail pages
        $f3->set('pageCSS',false); // Add file name if needed
        $f3->set('highlighterJavaScript',false); // Set to true for code sections
        $f3->set('pageJavaScript',false); // Add file name if needed
	}

    // HTTP route post-processor
	function afterroute($f3) {
        // Sort the languages for the language menu
        $lang_array = $f3->get('languages'); // languages is defined in config.ini
        uasort($lang_array, function ($a,$b) {
            return ($a[2] < $b[2]) ? -1 : 1;
        });
        // If a regular route, use the alias, otherwise
        // point the language menu to the home page (e.g. for error pages)
        if ($f3->exists('ALIAS',$alias_base)) {
            $alias_base = substr($alias_base,2); // the part after the lang prefix
        } else {
            $alias_base = '_home'; // for the error pages
        }
        
        $language_links_array = [];
        foreach($lang_array as $key=>$details) {
            array_push($language_links_array,
                [$key.$alias_base,$key,$details[0],$details[2]]);
        }
        $f3->set('languageLinks',$language_links_array);
        $pageLanguage = explode(',',$f3->get('LANGUAGE'));
        $f3->set('langCode',$pageLanguage[0]); // Use langCode for the html lang tag
        $lang_prefix = $f3->get('langSubdirectory'); // for local use in this function
        $f3->set('mainMenu', $f3->get($lang_prefix.'HomeMenu'));
        $f3->set('dropdownMenu', $f3->get($lang_prefix.'DropdownMenu'));
        // Render HTML layout
        echo \Template::instance()->render('layout.html','text/html');
        
	}

	// Instantiate class
	function __construct() {
		$f3=\Base::instance();
	}

}

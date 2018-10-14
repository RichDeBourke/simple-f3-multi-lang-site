<?php

/*

I initially used a filter for getting the file dates for the sitemap.xml file, but switched to using a function.

The filter was registered in index.php with:

// Register custom filter to get file dates for the sitemap.xml file
\Template::instance()->filter('fdate','\GetFileDate::instance()->fdate');

*/

// Base controller
class GetFileDate extends \Prefab {

    public function fdate($val) {
        if (file_exists('app/ui/'.$val.'.html')) {
           return date ("Y-m-d", filemtime('app/ui/'.$val.'.html'));
        } else {
            return "Error";
        }
	}
}

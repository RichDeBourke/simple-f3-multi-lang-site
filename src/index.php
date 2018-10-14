<?php

// Retrieve instance of the framework
$f3=require('lib/base.php');

// Load configuration
$f3->config('app/config.ini');

// Define routes
$f3->config('app/routes.ini');

// Define combined variable for scheme, host, and base
$schemeHost = $f3->get('SCHEME').'://'.$f3->get('HOST').$f3->get('BASE');
$f3->set('schemeHost',$schemeHost);

$f3->set('ONERROR','CommonPageController->error');

$f3->run();

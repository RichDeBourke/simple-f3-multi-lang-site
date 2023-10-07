<?php

//! Front-end processor
class enPageController extends Controller {

    //const

    // Note: F3 uses all uppercase names for Hive variables, so no risk with using 
    
    function loadCommonSettings($f3) {
        $f3->set('LANGUAGE','en');
        $f3->set('langSubdirectory','en');
    }

    function RenderHome($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','Site Construction');
        $f3->set('pageDescription','Building a frontend / backend setup for a simple, multi-language website using Bootstrap 4 with the Fat-Free PHP framework, but no database.');
        $f3->set('isHomePage',true);
        $f3->set('loadID',
            function($array,$count) {
                reset($array);
                for ($x = 0; $x < $count; $x++) {
                    next($array);
                }
                return key($array);
            }
        );
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails1($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','Setting up and modifying Bootstrap 4');
        $f3->set('pageDescription','This site is built with Bootstrap 4, using Sass for the styling and a modified mobile menu setup.');
        $f3->set('isDetailPage',true);
        $f3->set('highlighterJavaScript',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails2($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','Getting started with the Fat-Free Framework');
        $f3->set('pageDescription','Explanations for why I chose Fat-Free, how I install it, structure it, and manage different languages.');
        $f3->set('pageCSS','slider_css.html');
        $f3->set('isDetailPage',true);
        $f3->set('highlighterJavaScript',true);
        $f3->set('pageJavaScript','slider_script.html');
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails3($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','Configuring Fat-Free');
        $f3->set('pageDescription','The steps I used in configuring the Fat-Free Framework and setting up the files to run the site.');
        $f3->set('isDetailPage',true);
        $f3->set('highlighterJavaScript',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails4($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','Templates for Fat-Free');
        $f3->set('pageDescription','The benefit of using a PHP framework is being able to assemble webpages from separate templates for navigation, content, and the footer.');
        $f3->set('isDetailPage',true);
        $f3->set('highlighterJavaScript',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails5($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','Details that make a site better');
        $f3->set('pageDescription','There are a number of details that add to a more professionally functioning website.');
        $f3->set('isDetailPage',true);
        $f3->set('highlighterJavaScript',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function webpack($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','Using Webpack');
        $f3->set('pageDescription','Details on how I\'m using Webpack to build pages');
        $f3->set('googleNoIndex',true);
        $f3->set('isDetailPage',false);
        $f3->set('highlighterJavaScript',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

}

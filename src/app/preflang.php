<?php

/**
 * Preflang: a browser language detection plugin for the PHP Fat-Free Framework
 *
 * The contents of this file are subject to the terms of the GNU General
 * Public License Version 3.0. You may not use this file except in
 * compliance with the license. Any of the license terms and conditions
 * can be waived if you get permission from the copyright holder.
 *
 * @author Rich DeBourke
 * @see https://github.com/RichDeBourke
 */
class Preflang extends \Prefab {

    /* 
     * determine which language out of the available set of languages that the user prefers 
    */ 
    
	const
        E_NoLang='Configuration error. No language options have been defined!';
    
    // protected
    
    /**
	 * Match a language code from the browser's Accept-Language
     * value with an available language
	 * @param object $f3 instance
	 * @return string language subdirectory
	 */
    public function langDirectory($f3) {
        // get the array of languages from config.ini
        $available_languages=$f3->get('languages'); // languages is defined in config.ini
        if (!isset($available_languages) || !$available_languages) {
            user_error(self::E_NoLang,E_USER_ERROR);
        }

        // get the default language subdirectory
        reset($available_languages);
        $subdirectory_prefix = key($available_languages);
        
        // get the user's Accept-Language string
        $http_accept_language=$f3->get('LANGUAGE');
        if (!isset($http_accept_language) || !$http_accept_language) {
            return $subdirectory_prefix;
        }
         // test strings
         // English string: en-US,en;q=0.5
         // Korean test string: ko-KR,ko;q=0.8,en-US;q=0.5,en;q=0.3
         // Chinese test string: zh-HK;zh-CN;q=0.8,zh-TW;q=0.6,zh;q=0.4

        //$http_accept_language = 'en-US,en;q=0.5';

        $http_accept_language = str_replace('_', '-', $http_accept_language);
        preg_match_all('/([A-Za-z]{2,3})(-([A-Za-z]{2,3}))?/i', $http_accept_language, $language_groups, PREG_SET_ORDER);

        //echo count($language_groups).'<br>';

        foreach($language_groups as $group=>$language_code){
            //echo 'Browser - Group: '.$group.' code: '.$language_code[0].' - '.$language_code[1].'<br>';
            foreach($available_languages as $key=>$available) {
                //echo 'site languages: '.$available[0].' - '.$available[1].'<br>';
                if ($language_code[0] === $available[0] || $language_code[0] === $available[1]) {
                    //echo 'Match';
                    $subdirectory_prefix = $key;
                    break 2;
                }
            }
        }
        //echo $subdirectory_prefix;
        return $subdirectory_prefix;
    }

    //function __construct() {
		// No need for a __construct function
    //}
}

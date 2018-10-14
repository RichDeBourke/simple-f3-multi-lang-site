<?php

//! Front-end processor
class CommonPageController extends Controller {

    //const

    // Note: F3 uses all uppercase names for Hive variables, so no risk with using 
    
    function setLanguage($f3) {
        $lang_array = $f3->get('languages'); // languages is defined in config.ini
        if (preg_match('/^\/[A-Za-z]{2}\//',$f3->get('PATH'),$lang)) {
            $langString = trim($lang[0],'/');
            $valid = false;
            foreach ($lang_array as $key => $value){
                if ($key === $langString) {
                    $valid = true;
                    break;
                }
            }
            if (!$valid) {
                reset($lang_array);
                $langString = key($lang_array);
            }
        } else {
            $langString = \Preflang::instance()->langDirectory($f3);
        }
        $f3->set('LANGUAGE',$lang_array[$langString][0]);
        $f3->set('langSubdirectory',$langString);
        //echo $langString."<br>";
        //echo $f3->get('LANGUAGE')."<br>";
        //echo print_r($lang_array);
    }

    function contactNew($f3) {
        /*
            For contact, I can use route names, so can have alternate languages
        */
        $this->setLanguage($f3);
        $f3->set('googleNoIndex',true);
        $f3->set('pageTitle',$f3->get('dictContactPageTitle'));
        $f3->set('pageDescription',$f3->get('dictContactPageDescription'));
        $f3->set('isDetailPage',true);
        $f3->set('contactName','');
        $f3->set('contactEmail','');
        $f3->set('contactSubject','');
        $f3->set('contactMessage','');
        $f3->set('contactNameError','');
        $f3->set('contactEmailError','');
        $f3->set('contactSubjectError','');
        $f3->set('contactSuccess',false);
        // Set the content source
        $f3->set('pageContent','contact.html');
    }

    function contactPost($f3){

        function validateInput($data) {
            $bad = array("content-type","bcc:","to:","cc:","href");
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            foreach ($bad as $badString) {
                if (preg_match('/('.$badString.')/i',$data)) {
                    // If it looks like someone is trying to hack
                    // into the site via the contact page, then just stop.
                    exit;
                }
            }
            return $data;
        }

        function no_mail($a,$b,$c) {
            // my server doesn't support the php mail function
            // if your server does, change the no_mail function to mail
            return true;
        }
        
        // define variables and set to empty values
        $contactNameError = $contactEmailError = $contactSubjectError = "";
        $name = $email = $message = $success = "";

        $this->setLanguage($f3);

        if ($f3->exists('POST.name',$name)) {
            if ($name !== '') {
                $name = validateInput($name);
                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $contactNameError = $f3->get('dictContact17');
                } else { // valid name
                    $f3->set('contactName',$name);
                }
            } else {
                $contactNameError = $f3->get('dictContact12');
            }
        } else {
            $contactNameError = $f3->get('dictContact12');
        }

        if ($f3->exists('POST.email',$email)) {
            if ($email !== '') {
                $email = validateInput($email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $contactEmailError = $f3->get('dictContact14');
                } else { // valid email
                    $f3->set('contactEmail',$email);
                }
            } else {
                $contactEmailError = $f3->get('dictContact13');
            }
        } else {
            $contactEmailError = $f3->get('dictContact13');
        }

        if ($f3->exists('POST.subject',$subject)) {
            if ($subject !== '') {
                $subject = validateInput($subject);
                $f3->set('contactSubject',$subject);
            } else {
                $contactSubjectError = $f3->get('dictContact15');
            }
        } else {
            $contactSubjectError = $f3->get('dictContact15');
        }

        if ($f3->exists('POST.message',$message)) {
            $message = validateInput($message);
            $f3->set('contactMessage',$message);
        }

        if (($contactNameError === '') && ($contactEmailError === '') && ($contactSubjectError === '')) {
            // send the message
            $messageBody = "";
            unset($_POST['submit']);
            $messageBody = "Name: ".$name."\n";
            $messageBody .= "email: ".$email."\n";
            $messageBody .= "Subject: ".$subject."\n";
            $messageBody .= $message."\n";
            $messageBody = wordwrap($messageBody,70);
            
            $to = $f3->get('contactAddresses');
            $subject = 'Contact Submitted';
            if (no_mail($to, $subject, $messageBody)){
                $f3->set('contactSuccess',true);
            } else {
                // error sending the email to myself
            }
        } else {
            $f3->set('contactSuccess',false);
        }

        $f3->set('contactNameError', $contactNameError);
        $f3->set('contactEmailError', $contactEmailError);
        $f3->set('contactSubjectError', $contactSubjectError);

        $f3->set('googleNoIndex',true);
        $f3->set('pageTitle',$f3->get('dictContactPageTitle'));
        $f3->set('pageDescription',$f3->get('dictContactPageDescription'));
        $f3->set('isDetailPage',true);
        
        // Set the content source
        $f3->set('pageContent','contact.html');
    }

    function renderTerms($f3) {
        /*
            The Terms of Use / Privacy page is in just one language (the site's primary language), but the header/menus and the footer are provided in the user's selected language
        */
        $this->setLanguage($f3);
        $f3->set('googleNoIndex',true);
        $f3->set('pageTitle',$f3->get('dictTermsPageTitle'));
        $f3->set('pageDescription',$f3->get('dictTermsPageDescription'));
        $f3->set('isDetailPage',false);
        $f3->set('pageContent','terms.html');
    }

    function error($f3) {
        /*
            For error, there is no route name, so the language menu should point to the home pages
        */
        $this->setLanguage($f3);
        $f3->set('googleNoIndex',true);
        ob_clean();
        
        if ($f3->get('ERROR.code') === 404) {
            $f3->set('pageTitle',$f3->get('dict404PageTitle'));
            $f3->set('pageDescription',$f3->get('dict404PageDescription'));
            $f3->set('pageCSS','404_css.html');
            // Set the content source
            $f3->set('pageContent','404.html');
            $f3->set('pageJavaScript','404_script.html');
        } else { // 5XX error
            $f3->set('pageTitle',$f3->get('dict500PageTitle'));
            $f3->set('pageDescription',$f3->get('dict500PageDescription'));
            $f3->set('pageCSS','error_css.html');
            // Set the content source
            $f3->set('pageContent','error.html');
            $f3->set('pageJavaScript','error_script.html');
        }
    }




}

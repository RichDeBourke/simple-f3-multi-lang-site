A simple, multi-language website using Fat-Free
============================

## An almost complete (albeit simple) F3 setup

A frontend / backend setup for a simple, multi-language website using Bootstrap with the Fat-Free PHP framework, but no database. 


## Overview

I wanted a php framework to use with [Bootstrap 4](https://getbootstrap.com) to build websites that would:

* use templates for assembling the pages
* provide clean URLs
* support automatic language selection
* work on a shared server
* be easy to install (just copy and paste, no package manager required)

My choice was [Fat-Free](https://fatfreeframework.com) – *"a powerful yet easy-to-use PHP micro-framework"*

To be sure that I could actually build a site, I built [one](http://sbf-testing.byethost7.com); a site about how I used Bootstrap and Fat-Free to create a site. *And the demo is my record for what I did and why.*

*This is not a CMS. There is no database. All of the content is in the configuration file, the controller files, and the content templates.*

## Demo

All of the code from this repository is in operation at [http://sbf-testing.byethost7.com](http://sbf-testing.byethost7.com).<sup>1</sup> The intent is for the code to be an as-complete-as-possible package, rather than just a bare-bones starting point for building a site. The demo is running on a [free hosting service](https://byet.host/free-hosting) that provides PHP and Apache, but no email and most bots are blocked, so no contact form and no SSL<sup>2</sup> (that's why I say "an almost complete" site), but those should be easy enough to implement on a production host.

Note<sup>1</sup>: *The demo site, when visited with some older mobile phones, will sometimes redirect to a [Google page](https://support.google.com/accounts/answer/61416?co=GENIE.Platform%3DAndroid&hl=en) about cookies — I'm not sure why, but it's related to the free hosting service I'm using for the demo site. Reentering the URL should bring up the site.*

Note<sup>2</sup>: *The hosting service offers self-signed certificates, but I'm not sure Google accepts those for search ranking. Since the hosting service blocks most bots, it's difficult to get my ownership validated, so I'm running the site without SSL.*


## Applying the setup

All of my files for the demo site: Fat-Free configuration, controller, and template files, and the associated scss, image, and JavaScript files are in the GitHub repository. The Bootstrap and Fat-Free files are available for download from [Bootstrap](https://getbootstrap.com/) and [Fat-Free](https://fatfreeframework.com).

It should be easy enough to replace my site specific information with information for a different website.


## What's included (not a comprehensive list)

#### Fat-Free

* config.ini
* routes.ini
* all of the controller files
* all of the templates for the pages including:
    * head template with the code for font selection
    * navigation template with the code for assembling the links
    * sitemap template  
    
*The Fat-Free files are not included – those files are available from [Fat-Free](https://fatfreeframework.com)*

#### Bootstrap

Bootstrap is easy to structure with the available classes and using Sass. There were two things I changed from the standard Bootstrap code: 

* Switched from a dropdown menu on mobile devices to a slide-in menu
* Replaced the toggle button for the menu on mobile devices with an animated design

*The Bootstrap files are not included – those files are available from [Bootstrap](https://getbootstrap.com/)*

#### General website stuff

* Dynamic sitemap generation with xhtml:links for alternate languages
* [Font Face Observer](https://fontfaceobserver.com/) for font management (the site uses Google Noto Fonts)
* Scroll-to-top button that stops above the footer
* Overlay image slider – simple, jQuery based overlay slider
    * There are separate Scss and JavaScript files for the slider in the sass and js directories 
* Fixed hero image with quick loading
* Error response pages

#### Multi-language support

While the content for the [demo site](http://sbf-testing.byethost7.com) was written only in English, the demo does has Chinese and Korean pages to demonstrate the multi-language operation. The Chinese and Korean home pages were created from the English home page using Google Translate. The remainder of the Chinese and Korean pages, which are provided only to demonstrate the navigation, just have Google translations of the English pages' titles and descriptions.


## Compatibility
The demo site works with the latest versions of:
* Edge (desktop & Surface)
* Chrome (mobile & desktop)
* Firefox (mobile & desktop)
* Android (Samsung) Internet Browser
* Opera (mobile & desktop)
* Safari (mobile & desktop)

And with:
* IE 9, 10, & 11
    * *The site doesn't work with older versions of Internet Explorer, but a visitor will still be able to see the content as I serve a special CSS file and block the JavaScript files for IE8 and older.* 

## Licensing
This code is provided under an [MIT license](http://opensource.org/licenses/mit-license.php). See the [LICENSE](https://github.com/RichDeBourke/simple-f3-multi-lang-site/blob/master/LICENSE) file for details.

Fat-Free is provided under a [GNU Public License (GPL v3)](https://www.gnu.org/licenses/gpl-3.0.html)

Bootstrap is provided under an [MIT license](https://github.com/twbs/bootstrap/blob/master/LICENSE)

FontFaceObserver is provided under a [BSD-3-Clause license](https://github.com/bramstein/fontfaceobserver/blob/master/LICENSE)

OffCanvas Navigation is provided under an [MIT license](https://github.com/RichDeBourke/bootstrap4-offcanvas-nav/blob/master/LICENSE)


## Updates

**2019/01/02** – Validated the site works with Fat-Free 3.6.5 and updated some of the page content for better search engine results.

**2019/05/10** – Validated the site works with jQuery 3.4.1 and Bootstrap 4.3.1.

**2019/05/27** – Moved the section for the EU cookie notice to the bottom of the page as Google was sometimes including the notice text in the snippet on some search engine results pages.
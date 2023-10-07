A simple, multi-language website using Fat-Free
============================

## An almost complete (albeit simple) F3 setup

A frontend / backend setup for a simple, multi-language website using Bootstrap 4 with the Fat-Free PHP framework, but no database. 

## Overview

I wanted a php framework to use with [Bootstrap 4](https://getbootstrap.com) to build websites that would:

* use templates for assembling the pages
* provide clean URLs
* support automatic language selection
* work on a shared server
* be easy to install (just copy and paste, no package manager required)

My choice was [Fat-Free](https://fatfreeframework.com) – *"a powerful yet easy-to-use PHP micro-framework"*

To be sure that I could build a site, I created [one](http://sbf-testing.byethost7.com); a site about how I used Bootstrap and Fat-Free to create a site. *And the site is my record for what I did and why.*

*This is not a CMS. There is no database. All of the content is in the configuration file, the controller files, and the content templates.*

*Note: I have a similar repository for Bootstrap 5 at [https://github.com/RichDeBourke/simple-f3-bootstrap-5-multi-lang-site](https://github.com/RichDeBourke/simple-f3-bootstrap-5-multi-lang-site).

## Demo

All of the code from this repository is in operation at [http://sbf-testing.byethost7.com](http://sbf-testing.byethost7.com). The intent is for the code to be an as-complete-as-possible package, rather than just a bare-bones starting point for building a site. The demo is running on a [free hosting service](https://byet.host/free-hosting) that provides PHP and Apache, but no email and most bots are blocked, so no contact form and no SSL<sup>1</sup> (that's why I say "an almost complete" site), but those should be easy enough to implement on a production host.

Note<sup>1</sup>: *The hosting service offers self-signed certificates, but I'm not sure Google accepts those for search ranking. Since the hosting service blocks most bots, it's difficult to get my ownership validated, so I'm running the site without SSL.*

## Applying the setup

All of my files for the demo site, Fat-Free configuration, controller, and template files, and the associated SCSS, image, and JavaScript files are in this GitHub repository. The Bootstrap and Fat-Free files are available from [Bootstrap](https://getbootstrap.com/) and [Fat-Free](https://fatfreeframework.com).

It should be easy enough to replace my site specific content with content for a different website.

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
* Scroll-to-top button that stops above the footer
* Overlay image slider – simple, jQuery based overlay slider
  * There are separate Sass and JavaScript files for the slider in the sass and js directories 
* Fixed hero image with quick loading
* Error response pages

#### Multi-language support

While the content for the [demo site](http://sbf-testing.byethost7.com) is in English, the demo does have Chinese and Korean pages to demonstrate the multi-language operation. The Chinese and Korean home pages were created from the English home page using Google Translate. The remainder of the Chinese and Korean pages, which are provided only to demonstrate the navigation, just have Google translations of the English pages' titles and descriptions.

## Additional features for 2022

For the July 2022 update, in addition to verifying the site works with the latest versions of Fat-Free, Bootstrap 4, and jQuery, I also revised the site to:

* Use system fonts – switched from using Google fonts to using `system-ui` fonts. Using Google fonts requires the user's browser to send a request to Google for the stylesheet and the needed font files.  That involves sending the user's IP address to Google, which the EU General Data Protection Regulation (GDPR) says is not allowed. `system-ui` instructs the browser to use the same font the operating system uses to display text. This provides a similar look to what the user sees on the system screens, and it speeds up page startup time as there are no fonts to download.

* Self-host Bootstrap & jQuery files – switched from using Content Delivery Networks for framework and library files to providing the files from my server, again due to the GDPR requirement for not sharing user IP addresses with other sites. I am now using Webpack to combine jQuery, Bootstrap JavaScript, jQuery easing plugin, and the JavaScript for the site into one file (one file will download faster).

* Support prefers-reduced-motion – while Boostrap already supported the user setting for reduced motion, I did not adjust the jQuery animations. I do now.

* Support prefers-color-scheme – added a dark-mode format for users that prefer a dark format rather than a light format.

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
  * *The site doesn't work with older versions of Internet Explorer, but a visitor will still be able to see the content as I serve a special CSS file and block the JavaScript files for IE 8 and older.* 

## Licensing

This code is provided under an [MIT license](http://opensource.org/licenses/mit-license.php). See the [LICENSE](https://github.com/RichDeBourke/simple-f3-multi-lang-site/blob/master/LICENSE) file for details.

Fat-Free is provided under a [GNU Public License (GPL v3)](https://www.gnu.org/licenses/gpl-3.0.html)

Bootstrap is provided under an [MIT license](https://github.com/twbs/bootstrap/blob/master/LICENSE)

OffCanvas Navigation is provided under an [MIT license](https://github.com/RichDeBourke/bootstrap4-offcanvas-nav/blob/master/LICENSE)

## Updates

**2018/09/23** – Initial release.

**2019/01/02** – Validated the site works with Fat-Free 3.6.5 and updated some of the page content for better search engine results.

**2019/05/10** – Validated the site works with jQuery 3.4.1 and Bootstrap 4.3.1.

**2019/05/27** – Moved the section for the EU cookie notice to the bottom of the page as Google was sometimes including the notice text in the snippet on some search engine results pages.

**2019/07/02** – Implemented `display=swap` on the Google Fonts, which eliminates the need for a font manager, at least for Google Fonts (I was using [Font Face Observer](https://fontfaceobserver.com/)).

**2020/01/20** – Validated the site works with Fat-Free 3.7.1 and Bootstrap 4.4.1, and made some minor edits to the content.

**2020/07/05** – Validated the site works with Fat-Free 3.7.2, Bootstrap 4.5.0, and jQuery 3.5.1, eliminated the non-minified CSS files (just supplying minified CSS files on the website), and made some minor edits to the content (including an explanation about how I'm doing Sass in VS Code).

**2022/07/15** – Validated the site works with Fat-Free 3.8.0, Bootstrap 4.6.1, and jQuery 3.6.0, switched from Google fonts to using system fonts, added support for reduced motion and dark mode, and updated the content.

**2022/11/17** – Validated the site works with jQuery 3.6.1 and switched to providing normal and high resolution WEBP images for light and dark modes using picture and source elements.

**2023/07/09** – Add link to Bootstrap 5.3 with the Fat-Free PHP framework repository.

**2023/10/07** – Validated the site works with Bootstrap 4.6.2, and jQuery 3.7.1. The host for the demo site is now running PHP 8.2, so the demo is now using Fat-Free 3.8.2.

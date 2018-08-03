# Tweakr - Utility Toolkit #
Contributors: Andi Dittrich, AenonDynamics
Tags: tweaks, tools, security, api, json, rest-api, permalinks, editor, tinymce, sitemap, enhancement, tuning, extend, emoji, feeds, oembed, analytics, piwik, matomo, google analytics
Requires at least: 4.7
Tested up to: 4.9
Stable tag: 2.0
License: MIT X11-License
License URI: http://opensource.org/licenses/MIT

Supercharges your Blog with production grade Tweaks, Features and Utilities

## Description ##

This plugin is a collection of common used tweaks and features - each of them can be **controlled independently**
It is designed as compact **all-in-one solution** espacially for **Web-Agencies** and **Advanced Users** with security in mind: just audit and trust a single plugin.

### Visual Editor ###

* VisualComponent Extension visualizes the HTML Element Structure (headings,section,p)
* Remove the fixed-width restriction of the Editor-Area (set to 80% max)

### E-Mail ###

* Use **External SMTP Mailserver** to deliver mails transmitted by `wp_mail`
* No Third Party libraries required! WordPress Internal **PHPMailer** class is used
* Support for **TLS/SSL** Connections
* Set the Mail-From-Name and Mail-From-Address manually
* Fix phpmailerExceptions by setting the mail-from parameter to a valid address
* Control New User Registration E-Mails (send to admin and/or user)

### Automatic Updates ###

* Control Automatic-Update policy
* Enable automatic Theme Updates
* Enable automatic Plugin Updates
* Disable Automatic Updates
* Disable Update Notification (E-Mail)

### Permalinks/Rewrite Rules ###

* Add `.html` extension to pages - e.g. `privacy-protecton.html`
* Add `.html` extension to categories - e.g. `category/uncategorized.html`
* Remove **embed** Rewrite Rules
* Remove **feed** Rewrite Rules

### Virtual Permalink URLs ###
* Placeholders like `link://post.local/1234` can be used within the Link-Insert-Dialogs and got replaced by the real link during rendering - this avoids problems with different domains names.

### XML Sitemap ###
* Automatical XML Sitemap generation `sitemap.xml` (SEO)
* Modern Search-Engines like Google, Bing can easier index your posts/pages
* Only **Posts** and **Pages** are displayed
* Password protected posts/pages or unpublished content is ignored!
* XML Format regarding the [sitemaps.org specification](https://www.sitemaps.org/protocol.html)

### Security ###
* Disable XMLRPC API (Really!)
* Restrict REST (JSON) API Access to **Admin** and **Editor** User

### System Tweaks ###

* Disable Emojis
* Disable Smileys
* Disable oEmbeds
* Hide Admin Toolbar
* Hide WordPress Generator Tag
* Hide Windows Live Writer manifest file link
* Hide Meta Pagination Links
* Hide Feed Links
* Hide Resource Hints
* Disable RSS Feeds
* Disable Atom Feeds
* Disable RDF Feeds

### Google Analytics ###

* Google Analytics Support - just add your Tracking-ID
* AnonymizeIP Option
* OPT-OUT Shortcode/Button (required by GDPR/DSGVO) - also works with Caching Plugins or CDN Servers
* IE8 Compatible

### Matomo/Piwik Analytics ###

* Matomo v3 Support - add your Host URL + Site ID - thats it!
* OPT-OUT Shortcode/Button (required by GDPR/DSGVO) - also works with Caching Plugins or CDN Servers
* Simple Page Name Option (Records the Document Title without Blog Name)
* DoNoTrack Option
* Option to add the Hostname to your Document Title (useful for multidomain sites)

## Installation ##

### System requirements ###
* PHP 5.4 or greater
* WordPress 4.7

### Installation ###
1. Upload the complete `tweakr` folder (Wordpress Plugin) to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings -> Tweakr and configure it

## Frequently Asked Questions ##

### A lot of the Tweaks/Extensions are already available as Single Plugins ###
Of course! But as a professional Web Agency it is much easier to develope, maintain and audit a single plugin instead of a set of 20+ plugins from different authors!

### Why do you use your custom tracking code for Piwik/Google Analytics ###
Because of the Opt-Out Buttons code and the possibility to control the options via the settings page.

### I miss some features / I found a bug ###
Send an email to Andi Dittrich (andi _D0T dittrich At a3non .dOT org) or or open a [New Issue on GitHub](https://github.com/AndiDittrich/WordPress.Tweakr/issues)

## Screenshots ##

1. Settings Page Overview
2. VisualComponent Extension
3. Google Analytics Options
4. Piwik Analytics Options
5. E-Mail SMTP Settings
6. Analytics OPT-OUT Button

## Upgrade Notice ##




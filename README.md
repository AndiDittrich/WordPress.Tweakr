# Tweakr Toolkit #
Contributors: Andi Dittrich, aenondynamics
Tags: tweaks, tools, hacks, api, json, rest-api, enhancement, tuning, extend, enhancement, emoji, feeds, oembed, analytics, piwik, google analytics
Requires at least: 4.7
Tested up to: 4.7
Stable tag: 1.1
License: MIT X11-License
License URI: http://opensource.org/licenses/MIT

Extend your Blog with common used Tweaks, Features and Utilities

## Description ##

This plugin is a collection of common tweaks and features we've created for our customers.
It is designed as compact **all-in-one** solution espacially for **Web-Agencies** and **Advanced Users**.

### Plugin Features ###

### Tweaks ###
The following WordPress Features can be **controlled separately**

* Disable XMLRPC API (Really!)
* Restrict REST (JSON) API Access to **Admin** and **Editor** User
* Disable Emojis
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

### Visual Editor ###

* VisualComponent Extension visualize the HTML Element Structure (headings,section,p)
* Remove the fixed-width restriction of the Editor-Area (set to 80% max)

### E-Mail ###

* Use External **SMTP** Mailserver to deliver mails transmitted by `wp_mail`
* No Third Party libraries required! WordPress Internal **PHPMailer** class is used
* Support for **TLS/SSL** Connections
* Set the Mail-From-Name and Mail-From-Address manually
* Fix phpmailerExceptions by setting the mail-from parameter to a valid address
* Control New User Registration E-Mails (send to admin and/or user)

### Permalinks/Rewrite Rules ###

* Add `.html` extension to pages - e.g. `privacy-protecton.html`
* Add `.html` extension to categories - e.g. `category/uncategorized.html`
* Remove **embed** Rewrite Rules
* Remove **feed** Rewrite Rules

### Google Analytics ###

* Google Analytics Support - just add your Tracking-ID
* AnonymizeIP Option
* OPT-OUT Shortcode/Button - also works with Caching Plugins or CDN Servers
* IE8 Compatible

### Piwik Analytics ###

* Piwik3 Support - add your Piwik Host URL + Site ID - thats it!
* OPT-OUT Shortcode/Button - also works with Caching Plugins or CDN Servers
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

1. General Tweaks
2. Analytics OPT-OUT Button
2. Google Analytics Options
2. Piwik Analytics Options

## Upgrade Notice ##




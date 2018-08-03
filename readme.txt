=== Tweakr - Utility Toolkit ===
Contributors: Andi Dittrich, AenonDynamics
Tags: tweaks, tools, security, api, json, rest-api, permalinks, editor, tinymce, sitemap, enhancement, tuning, extend, emoji, feeds, oembed, analytics, piwik, matomo, google analytics
Requires at least: 4.7
Tested up to: 4.9
Stable tag: 2.0
License: MIT X11-License
License URI: http://opensource.org/licenses/MIT

Supercharges your Blog with production grade Tweaks, Features and Utilities

== Description ==

This plugin is a collection of common used tweaks and features - each of them can be **controlled independently**
It is designed as compact **all-in-one solution** espacially for **Web-Agencies** and **Advanced Users** with security in mind: just audit and trust a single plugin.

= Visual Editor =

* VisualComponent Extension visualizes the HTML Element Structure (headings,section,p)
* Remove the fixed-width restriction of the Editor-Area (set to 80% max)

= E-Mail =

* Use **External SMTP Mailserver** to deliver mails transmitted by `wp_mail`
* No Third Party libraries required! WordPress Internal **PHPMailer** class is used
* Support for **TLS/SSL** Connections
* Set the Mail-From-Name and Mail-From-Address manually
* Fix phpmailerExceptions by setting the mail-from parameter to a valid address
* Control New User Registration E-Mails (send to admin and/or user)

= Automatic Updates =

* Control Automatic-Update policy
* Enable automatic Theme Updates
* Enable automatic Plugin Updates
* Disable Automatic Updates
* Disable Update Notification (E-Mail)

= Permalinks/Rewrite Rules =

* Add `.html` extension to pages - e.g. `privacy-protecton.html`
* Add `.html` extension to categories - e.g. `category/uncategorized.html`
* Remove **embed** Rewrite Rules
* Remove **feed** Rewrite Rules

= Virtual Permalink URLs =
* Placeholders like `link://post.local/1234` can be used within the Link-Insert-Dialogs and got replaced by the real link during rendering - this avoids problems with different domains names.

= XML Sitemap =
* Automatical XML Sitemap generation `sitemap.xml` (SEO)
* Modern Search-Engines like Google, Bing can easier index your posts/pages
* Only **Posts** and **Pages** are displayed
* Password protected posts/pages or unpublished content is ignored!
* XML Format regarding the [sitemaps.org specification](https://www.sitemaps.org/protocol.html)

= Security =
* Disable XMLRPC API (Really!)
* Restrict REST (JSON) API Access to **Admin** and **Editor** User

= System Tweaks =

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

= Google Analytics =

* Google Analytics Support - just add your Tracking-ID
* AnonymizeIP Option
* OPT-OUT Shortcode/Button (required by GDPR/DSGVO) - also works with Caching Plugins or CDN Servers
* IE8 Compatible

= Matomo/Piwik Analytics =

* Matomo v3 Support - add your Host URL + Site ID - thats it!
* OPT-OUT Shortcode/Button (required by GDPR/DSGVO) - also works with Caching Plugins or CDN Servers
* Simple Page Name Option (Records the Document Title without Blog Name)
* DoNoTrack Option
* Option to add the Hostname to your Document Title (useful for multidomain sites)

== Installation ==

= System requirements =
* PHP 5.4 or greater
* WordPress 4.7

= Installation =
1. Upload the complete `tweakr` folder (Wordpress Plugin) to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings -> Tweakr and configure it

== Frequently Asked Questions ==

= A lot of the Tweaks/Extensions are already available as Single Plugins =
Of course! But as a professional Web Agency it is much easier to develope, maintain and audit a single plugin instead of a set of 20+ plugins from different authors!

= Why do you use your custom tracking code for Piwik/Google Analytics =
Because of the Opt-Out Buttons code and the possibility to control the options via the settings page.

= I miss some features / I found a bug =
Send an email to Andi Dittrich (andi _D0T dittrich At a3non .dOT org) or or open a [New Issue on GitHub](https://github.com/AndiDittrich/WordPress.Tweakr/issues)

== Screenshots ==

1. Settings Page Overview
2. VisualComponent Extension
3. Google Analytics Options
4. Piwik Analytics Options
5. E-Mail SMTP Settings
6. Analytics OPT-OUT Button

== Upgrade Notice ==



== Changelog ==

= 2.0 =

**License changed to GNU GENERAL PUBLIC LICENSE Version 2 (GPL-2.0)**

* Added: option to control automatic updates (enable/disable updates by each component)
* Added: option to hide privacy-policy page from search engines
* Added: option to advertise the `sitemap.xml` in `robots.txt` file to be autoamitcally recognized by search engines
* Added: option to disable smiley images (convert_smilies)
* Added: option to center TinyMCE (VisualEditor) content within editing area (enhancement for large screens)
* Added: VisualComponent styles for list elements `ul`, `ol`
* Changed: updated the UI components
* Changed: `wp-skltn` library updated to **0.16.0** - MPL 2.0 License
* Changed: sessionStorage is used to store the current active tab instead of cookies
* Changed: moved sitemap settings to content section
* Changed: renamed Piwik Analytics to Matomo - see https://matomo.org/blog/2018/01/piwik-is-now-matomo/
* Removed: `jquery-cookie` dependency

= 1.4 =
* Added: Option to remove trailing-slashes from all permalinks
* Added: Option to add `.html` extensions to custom taxonomies - feature requested on [WordPress.org Forums](https://wordpress.org/support/topic/add-html-to-custom-taxonomies-categories/)
* Added: Virtual Permalinks to the Link-Insert-Dialogs. Placeholders like `link://post.local/1234` are used and replaced by the real link during rendering - this avoids problems with different domains
* Added: Virtual Permalinks to the Media-Insert-Dialogs. Placeholders like `link://attachment.local/1234` are used.
* Added: Option to remove shortlink from HTTP-Header
* Added: Option to remove REST-API URL from HTTP-Header
* Added: Option to disable pingbacks/trackbacks for all posts/pages (set to closed)
* Added: REST API Monitoring endpoint `<hostname>/wp-json/tweakr/v1.0/monitoring`
* Changed: By disabling the XMLRPC API the related HTTP-Header **X-Pingback** will be disabled
* Changed: Permalink Settings are moved to the **Content** pane

= 1.3 =
* Added: XML Sitemap Generator
* Bugfix: Plugin Re-Activation doesn't flush (initialize) the rewrite rules

= 1.2 =
* Added: VisualComponents Extension to visualize the HTML Element Structure in Visual Editor Mode (headings,section,p)
* Added: SMTP Mail Transport settings to deliver mails via external Mailserver
* Added: Option to remove Rewrite Rules for all types of Feeds (RSS, RTF, ATOM, RSS2)
* Added: Option to add `.html` extensions to **Pages** or **Categories**
* Added: E-Mail settings to set the mail-from-address as well as mail-from-name manually
* Changed: Settings Page Structure has been modified
* Changed: New Piwik and Google Analytics Code
* Changed: "Disable XMLRPC" will now force the `xmlrpc.php` Endpoint to return a HTTP403 Response
* Changed: TinyMCE Autowidth is set to **95%**
* Changed: **Disable oEmbeds** removes also the related Rewrite Rules as well as the endpoint (embed.php template page)
* Changed: Renamed the setting of "Fix Mail-From" - has to be activated again

= 1.1 =
* Added: Google Analytics Tracking Option
* Added: Piwik Analaytics Tracking Option
* Added: Option to set the VisualEditor width to auto (max 80 percent)
* Added: Mailfrom-Fix - it solves problems with phpmailerExceptions which are caused by a malformed/invalid email-from-address.
* Added: New User Notification Control - enable/disable notification E-Mails for admin and/or the new user
* **PHP >= 5.4** is required

= 1.0 =
* Initial public release.
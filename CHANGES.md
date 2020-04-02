## Changelog ##

### 2.1 ###

* Added: option to set the `.html` extension as optional
* Changed: new plugin menu structure
* Changed: `wp-skltn` library updated to **0.22.1** - MPL 2.0 License
* Changed: applied new `wp-skltn` plugin structure - files moved into `modules/` directory
* Bugfix: invalid regex in `.html` extension rewrite rule accepted any character instead of a dot
* Bugfix: metadata generator throws a php notice due to non extisting global `$post` object

### 2.0 ###

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

### 1.4 ###
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

### 1.3 ###
* Added: XML Sitemap Generator
* Bugfix: Plugin Re-Activation doesn't flush (initialize) the rewrite rules

### 1.2 ###
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

### 1.1 ###
* Added: Google Analytics Tracking Option
* Added: Piwik Analaytics Tracking Option
* Added: Option to set the VisualEditor width to auto (max 80 percent)
* Added: Mailfrom-Fix - it solves problems with phpmailerExceptions which are caused by a malformed/invalid email-from-address.
* Added: New User Notification Control - enable/disable notification E-Mails for admin and/or the new user
* **PHP >= 5.4** is required

### 1.0 ###
* Initial public release.
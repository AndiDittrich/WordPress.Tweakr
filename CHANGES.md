## Changelog ##

### 1.4 ###
* Added: Option to remove trailing-slashes from all permalinks
* Added: Option to add `.html` extensions to custom taxonomies - feature requested on [WordPress.org Forums](https://wordpress.org/support/topic/add-html-to-custom-taxonomies-categories/)

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
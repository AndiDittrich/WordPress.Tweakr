## Changelog ##

### 1.2 ###
* Added: VisualComponents Extension to visualize the HTML Element Structure in Visual Editor Mode (headings,section,p)
* Added: Option to remove Rewrite Rules for all types of Feeds (RSS, RTF, ATOM, RSS2)
* Changed: "Disable XMLRPC" will now force the `xmlrpc.php` Endpoint to return an HTTP403 Response
* Changed: TinyMCE Autowidth is set to **95%**
* Changed: **Disable oEmbeds** removes also the related Rewrite Rules as well as the endpoint (embed.php template page)

### 1.1 ###
* Added: Google Analytics Tracking Option
* Added: Piwik Analaytics Tracking Option
* Added: Option to set the VisualEditor width to auto (max 80 percent)
* Added: Mailfrom-Fix - it solves problems with phpmailerExceptions which are caused by a malformed/invalid email-from-address.
* Added: New User Notification Control - enable/disable notification E-Mails for admin and/or the new user
* **PHP >= 5.4** is required

### 1.0 ###
* Initial public release.
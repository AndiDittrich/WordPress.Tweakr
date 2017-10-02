WordPress Monitoring
=================================

Tweakr provides a build-in REST-Endpoint to monitor all installed plugins and themes. 
This feature is espacially designed for Web-Agencies to monitor their client systems with external tools.

## REST API ##

URL: `<hostname>/wp-json/tweakr/v1.0/monitoring`

The endpoint requires an authentication of a user which owns `manage_options` capabilities.

## Response Object ##

```javascript
{
    wp_version: '4.8.2',
    php_version: '5.6.30-0+deb8u1',
    plugins: [
        {
            active: true,
            name: "Tweakr Toolkit",
            url: "https://andidittrich.de/go/tweakr",
            version: "1.4-BETA2"
        },
        ...
    ],
    themes: [
        {
            name: 'Twenty Fourteen',
            version: '2.0'
        },
        ...
    ]
}

```

## Example Response ##

```json
{"wp_version":"4.8.2","php_version":"5.6.30-0+deb8u1","plugins":[{"name":"bbPress","version":"2.5.12","url":"https:\/\/bbpress.org","active":false},{"name":"BuddyPress","version":"2.8.2","url":"https:\/\/buddypress.org\/","active":false},{"name":"Cryptex - E-Mail Address Protection","version":"6.0","url":"https:\/\/andidittrich.de\/go\/cryptex","active":false},{"name":"Enlighter - Customizable Syntax Highlighter","version":"3.5","url":"https:\/\/enlighterjs.org","active":true},{"name":"Enlighter Pro","version":"3.1-BETA2","url":"http:\/\/enlighterjs.org","active":false},{"name":"Jetpack by WordPress.com","version":"4.9","url":"http:\/\/jetpack.com","active":false},{"name":"Rewrite Rules Inspector","version":"1.2.1","url":"http:\/\/wordpress.org\/extend\/plugins\/rewrite-rules-inspector\/","active":false},{"name":"TESTCASE1","version":"1.2-BETA1","url":"https:\/\/andidittrich.de\/go\/tweakr","active":false},{"name":"TinyMCE Advanced","version":"4.5.6","url":"http:\/\/www.laptoptips.ca\/projects\/tinymce-advanced\/","active":false},{"name":"Tweakr Toolkit","version":"1.4-BETA2","url":"https:\/\/andidittrich.de\/go\/tweakr","active":true},{"name":"WP Super Cache","version":"1.4.9","url":"https:\/\/wordpress.org\/plugins\/wp-super-cache\/","active":false}],"themes":[{"name":"Hueman","version":"3.3.20"},{"name":"Test Theme","version":"1.0.0"},{"name":"Twenty Fifteen","version":"1.8"},{"name":"Twenty Fourteen","version":"2.0"},{"name":"Twenty Sixteen","version":"1.3"},{"name":"Twenty Thirteen","version":"2.1"}]}
```
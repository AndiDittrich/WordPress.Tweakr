// Tweakr Analytics Tracking Code with OPT-OUT Button
(function(_document, cookieName, trackingID, anonymizeIP){
    // get optout button
    var optoutButton = _document.getElementById('tweakr-ga-optout');

    var buttonDisabled = function(){
        optoutButton.innerHTML = optoutButton.getAttribute('data-text-disabled');
        optoutButton.className = 'tweakr-ga-out';
    };

    // opt-out cookie not set ?
    if (_document.cookie.indexOf(cookieName) == -1){
        // opt-out button visible on current page ?
        if (optoutButton){
            // listen to onclick event
            optoutButton.addEventListener('click', function(evt){
                evt.preventDefault();

                // create expire date NOW() + 10 Years
                var expire = new Date();
                expire.setTime(expire.getTime() + 1000 * 60 * 60 * 24 * 365 * 10);

                // set cookie
                _document.cookie = cookieName + '1;path=/;expires=' + expire.toGMTString() + ';';

                // trigger disabled action
                buttonDisabled();
            }); 
        }

        // Google Analytics Code Snippet
        // @see https://developers.google.com/analytics/devguides/collection/analyticsjs/tracking-snippet-reference
        (function(_window, scriptTag){
            // Acts as a pointer to support renaming - Not used by Tweakr
            _window['GoogleAnalyticsObject'] = 'ga';

            // Creates an initial ga() function.
            // The queued commands will be executed once analytics.js loads.
            _window.ga = _window.ga || function(){
                (_window.ga.q = _window.ga.q || []).push(arguments)
            };

            // Sets the time (as an integer) this tag was executed - Used for timing hits.
            _window.ga.l = 1 * new Date();

            // create script tag
            var trackerScript = _document.createElement(scriptTag);
            trackerScript.type = 'text/javascript';
            trackerScript.async = true;
            trackerScript.src= 'https://www.google-analytics.com/analytics.js'; 
            
            // insert script element to the top and load analytics.js
            var scriptElementAnchor = _document.getElementsByTagName(scriptTag)[0];
            scriptElementAnchor.parentNode.insertBefore(trackerScript, scriptElementAnchor);
        })(this, 'script');

        // Google Analytics Init
        ga('create', trackingID, 'auto');
        ga('set', 'anonymizeIp', anonymizeIP);
        ga('send', 'pageview');

    // cookie set
    }else{
        // change button text
        if (optoutButton){
            buttonDisabled();
        }
    }

// initialize - we don't call the function directly to avoid optimization of unused arguments which are added dynamicsally to the code!
}).call(window, document, 'tweakr-ga-optout=');